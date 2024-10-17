import Alpine from "alpinejs"

const loadSearching = () => {
    Alpine.data('loadSearching', () => ({
        searchInput: null,
        searchResults: [],
        toggle: false,
        loading: false,
        error: false,
        init() {

            this.$nextTick(() => {
                this.searchInput = document.querySelector('#search-input')
            })

            document.addEventListener('keyup', (e) => {
                if(e.key == 'Escape' && this.toggle) {
                    this.close()
                }
            })
        },
        async getData(e) {
            if(e.target.value === '') return

            this.loading = true
            this.searchResults = []
            this.error = false
            const data = await (await fetch(`http://localhost:10003/wp-json/wp/v2/posts?search=${e.target.value}`)).json()
            this.searchResults = data
            this.loading = false

            if(this.searchResults.length === 0) this.error = true
        },
        open() {
            this.toggle = true
            document.body.style.overflowY =  'hidden'
        },
        close() {
            this.toggle = false
            this.searchInput.value = ''
            this.searchResults = []
            document.body.style.overflowY =  'scroll'
        }
    }))
}

export default loadSearching