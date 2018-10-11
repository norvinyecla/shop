<template>
    <div class='row'>
        <h3>Editing product</h3>
        <form action="#" enctype="multipart/form-data" @submit.prevent="saveProduct()">
            <div class="input-group">
                <fieldset>
                    <label>Name</label>
                    <input v-model="product.name" type="text" name="name" class="form-control" autofocus>
                </fieldset>
                <fieldset>
                    <label>Description</label>
                    <input v-model="product.description" type="text" name="description" class="form-control">
                </fieldset>
                <fieldset>
                    <label>Price</label>
                    <input v-model="product.price" type="text" name="price" class="form-control">
                </fieldset>
                
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">
                        <span>Edit product</span>
                    </button>

                    <button type="reset" class="btn btn-secondary" @click="hideForm">
                        <span>Cancel</span>
                    </button>
                </span>
            </div>
        </form>
    </div>
</template>

<script>
    import { EventBus } from '../event-bus.js'
    export default {
        props: [ 'product' ],
        data() {
            return {
                title: '',
                message: ''
            };
        },
        
        created() {

        },
        
        methods: {
            onFileChange(e) {
                this.product.picture = this.$refs.picture.files[0];
            },

            hideForm() {
                EventBus.$emit('hide_form')
            },

            editProduct(formData) {
                axios(
                    {
                        method: 'PUT',
                        url: 'api/update/' + this.product.id, 
                        data: formData,
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then((res) => {
                        alert('Successfully updated this product!')  
                        EventBus.$emit('refresh')
                    })
                    .catch((err) => {
                        alert('Cannot edit this product. Please check your values')
                    })
            },
 
            saveProduct(product) {
                var formData = new FormData()
                formData.append("name", this.product.name)
                formData.append("price", this.product.price)
                formData.append("description", this.product.description)
                this.editProduct(formData)
            }
        }
    }
</script>