import Alpine from 'alpinejs'

export default () => {
    Alpine.data('professorLike', () => ({
        active: false,
        count: 0,
        professorId: null,
        likeRecordId: null,
        headers: {},
        init() {
            this.count = this.$root.dataset.count
            this.active = this.$root.dataset.userHasData > 0
            this.professorId = this.$root.dataset.professorId
            this.likeRecordId = this.$root.dataset.likeRecordId

            // Remove keys with null/undefined/'' values from headers
            let headers = {
                'X-WP-Nonce': document.body.dataset.nonce,
                'Content-Type': 'application/json'
            }
            this.headers = Object.fromEntries(
                Object.entries(headers).filter(([_, value]) => value !== null && value !== undefined && value !== '')
            );
        },
        toggle() {
            this.active = !this.active
            this.active ? this.increment() : this.decrement()
        },
        async increment() {
            try {

                const response = await fetch('http://localhost:10003/wp-json/arbor/v1/likes', 
                    {
                        method: 'POST',
                        body: JSON.stringify({'professorId':this.professorId}),
                        headers: this.headers
                    }
                )
            
                if(![200, 201].includes(response.status)) {
                    const responseData = await response.json()
                    const message = responseData.data?.message || responseData.message
                    throw new Error(message)
                }

                const data = await response.json()
                this.likeRecordId = data.likeId

                this.count++
            } catch(err) {
                console.log(err)
                this.active = !this.active
            }
        },
        async decrement() {
            try {
                const response = await fetch('http://localhost:10003/wp-json/arbor/v1/likes', 
                    {
                        method: 'DELETE',
                        body: JSON.stringify({likeId: this.likeRecordId}),
                        headers: this.headers
                    }
                )
            
                if(![200, 201].includes(response.status)) {
                    const responseData = await response.json()
                    const message = responseData.data?.message || responseData.message
                    throw new Error(message)
                }

                this.count--
            } catch(err) {
                console.log(err)
                this.active = !this.active
            }
        }
    }))
}