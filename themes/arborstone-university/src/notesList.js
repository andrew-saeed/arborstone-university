import Alpine from "alpinejs"

export default () => {
    Alpine.data('note', () => ({
        currentId: null,
        itemInputText: null,
        itemTextArea: null,
        editMode: false,
        currentTitle: '',
        currentBody: '',
        processing: false,
        init() {
            this.currentId = this.$el.dataset.id
            this.$root.style.maxHeight = `${this.$root.scrollHeight + 80}px`

            this.$nextTick(() => {
                this.itemInputText = this.$root.querySelector('input')
                this.itemTextArea = this.$root.querySelector('textarea')
            })
        },
        async deleteItem() {
            if(this.processing) return

            try {
                this.processing = true

                await fetch(`http://localhost:10003/wp-json/wp/v2/note/${this.currentId}`, {
                    method: 'DELETE', 
                    headers: {
                        'X-WP-Nonce': document.body.dataset.nonce
                    }
                })

                this.$root.style.maxHeight = '0px'

                this.processing = false
            } catch(err) {
                console.log('error')
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

                await fetch(`http://localhost:10003/wp-json/wp/v2/note/${this.currentId}`, {
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

                this.currentTitle = this.itemInputText.value 
                this.currentBody = this.itemTextArea.value

                this.processing = false
            } catch(err) {
                console.log('error')
                this.processing = false
            }
        }
    }));
}