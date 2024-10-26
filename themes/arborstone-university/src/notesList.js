import Alpine from "alpinejs"

export default () => {
    Alpine.store('notesStore', {
        collection: [],
        formatNote(note) {
            return {
                id: note.id,
                title: note.title.rendered.replace('Private:', ''),
                content: note.content.rendered.replace(/<[^>]*>/g, '')
            }
        },
        async getUserNotes(authorid) {
            const data = await (await fetch(`http://localhost:10003/wp-json/wp/v2/note/?author=${authorid}&status=private`, {
                method: 'GET',
                headers: {
                    'X-WP-Nonce': document.body.dataset.nonce
                }
            })).json()

            this.collection = data.map((item) => {
                return this.formatNote(item)
            })
        },
        addNewNote(note) {
            this.collection = [this.formatNote(note), ...this.collection]
        },
        updateNote(note) {
            const formatedNote = this.formatNote(note)
            this.collection = this.collection.map((item) => {
                return item.id === formatedNote.id ? formatedNote : item
            })
        },
        deleteNote(deletedNoteId) {
            this.collection = this.collection.filter((item) => {
                return `${item.id}` !== `${deletedNoteId}`
            })
        }
    })

    Alpine.data('notesList', () => ({
        init() {
            const authorid = this.$el.dataset.authorid
            Alpine.store('notesStore').getUserNotes(authorid)
        }
    }))

    Alpine.data('noteItem', () => ({
        itemId: null,
        itemInputText: null,
        itemTextArea: null,
        editMode: false,
        currentTitle: '',
        currentBody: '',
        processing: false,
        init() {
            this.$root.style.maxHeight = `${this.$root.scrollHeight + 80}px`

            this.$nextTick(() => {
                this.itemInputText = this.$root.querySelector('input')
                this.itemTextArea = this.$root.querySelector('textarea')
                this.itemId = this.$root.dataset.id
            })

            this.$root.addEventListener('transitionend', () => {
                if(this.$root.style.maxHeight === '0px') {
                    
                    Alpine.store('notesStore').deleteNote(this.itemId)
                }
            })
        },
        async deleteItem() {
            if(this.processing) return

            try {
                this.processing = true

                const response = await fetch(`http://localhost:10003/wp-json/wp/v2/note/${this.itemId}`, {
                    method: 'DELETE', 
                    headers: {
                        'X-WP-Nonce': document.body.dataset.nonce
                    }
                })

                if(![200, 201].includes(response.status)) {
                    const responseData = await response.json()
                    const message = responseData.data?.message || responseData.message
                    throw new Error(message)
                }

                this.$root.style.maxHeight = '0px'

                this.processing = false
            } catch(err) {
                console.log(err)
                this.processing = false
            }
        },
        toggleEdit() {
            if(this.processing) return

            this.editMode = !this.editMode

            if(this.editMode) {
                this.currentTitle = this.itemInputText.value
                this.currentBody = this.itemTextArea.value

                this.itemInputText.removeAttribute('readonly')
                this.itemTextArea.removeAttribute('readonly')
            } else {
                this.itemInputText.value = this.currentTitle
                this.itemTextArea.value = this.currentBody

                this.itemInputText.setAttribute('readonly', '')
                this.itemTextArea.setAttribute('readonly', '')
            }
        },
        async updateItem() {
            if(this.processing) return

            try {
                this.processing = true

                const response = await fetch(`http://localhost:10003/wp-json/wp/v2/note/${this.itemId}`, {
                    method: 'POST',
                    body: JSON.stringify({
                        title: this.itemInputText.value,
                        content: this.itemTextArea.value
                    }),
                    headers: {
                        'X-WP-Nonce': document.body.dataset.nonce,
                        'Content-Type': 'application/json'
                    }
                })

                if(![200, 201].includes(response.status)) {
                    const responseData = await response.json()
                    const message = responseData.data?.message || responseData.message
                    throw new Error(message)
                }

                const updatedNote = await response.json()

                this.currentTitle = this.itemInputText.value 
                this.currentBody = this.itemTextArea.value

                this.processing = false
                this.toggleEdit()
                Alpine.store('notesStore').updateNote(updatedNote)
            } catch(err) {
                console.log(err)
                this.processing = false
            }
        }
    }));

    Alpine.data('createNewNote', () => ({
        open: false,
        noteTitle: '',
        noteContent: '',
        error: null,
        toggleModal() {
            this.open = !this.open
            if(this.open) {
                this.noteTitle = ''
                this.noteContent = ''
                this.error = null
            }
        },
        async save() {
            if(this.error) return

            try {
                const response = await fetch('http://localhost:10003/wp-json/wp/v2/note', {
                    method: 'POST',
                    body: JSON.stringify({
                        title: this.noteTitle,
                        content: this.noteContent,
                        status: 'private'
                    }),
                    headers: {
                        'X-WP-Nonce': document.body.dataset.nonce,
                        'Content-Type': 'application/json'
                    }
                })
                
                if(![200, 201].includes(response.status)) {
                    const responseData = await response.json()
                    const message = responseData.data?.message || responseData.message
                    throw new Error(message)
                }

                const newNote = await response.json()

                this.toggleModal()
                Alpine.store('notesStore').addNewNote(newNote)
            } catch(err) {
                this.error = err.message
            }
        }
    }))
}