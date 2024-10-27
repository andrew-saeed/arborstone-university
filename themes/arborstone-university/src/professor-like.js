import Alpine from 'alpinejs'

export default () => {
    Alpine.data('professorLike', () => ({
        active: false,
        count: 0,
        init() {
            this.count = this.$root.dataset.count
            this.active = this.$root.dataset.userHasData > 0
        },
        toggle() {
            this.active = !this.active
            this.active ? this.increment() : this.decrement()
        },
        increment() {
            this.count++
        },
        decrement() {
            this.count--
        }
    }))
}