import Alpine from "alpinejs"

export default () => {
    Alpine.data('note', () => ({
        currentId: null,
        init() {
            this.currentId = this.$el.dataset.id
            this.$root.style.maxHeight = `${this.$root.scrollHeight}px`
        },
        async deleteItem() {
            try {
                await (await fetch(`http://localhost:10003/wp-json/wp/v2/note/${this.currentId}`, 
                    {
                        method: 'DELETE', 
                        headers: {
                            'X-WP-Nonce': document.body.dataset.nonce
                        }
                    })).json()
                this.$root.style.maxHeight = '0px'
            } catch(err) {
                console.log('error')
            }
        },
        animateItem() {
            this.$root.style.maxHeight = '0px'
        }
    }));
}