<template>
    <div class='row'>
        <h3>
            <span v-if="mode == 'add'">Creating product</span>
            <span v-else>Editing product</span>
        </h3>
        <form action="#" enctype="multipart/form-data" @submit.prevent="saveProduct()">
            <div class="input-group">
                <input type="hidden" ref="id" name="id" class="form-control" v-model="product.id">
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
                <fieldset v-if="mode == 'add'">
                    <label>Picture</label>
                    <input v-on:change=onFileChange type="file" ref="picture" name="picture" class="form-control" autofocus>
                </fieldset>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">
                        <span v-if="mode == 'add'">Create product</span>
                        <span v-else>Edit product</span>
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
        props: [ 'product', 'mode' ],
        data() {

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

            createProduct(formData) {
                axios(
                    {
                        method: 'POST',
                        url: 'api/add', 
                        data: formData,
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then((res) => {
                        this.product.name = ''
                        this.product.description = ''
                        this.product.price = 0
                        this.product.picture = false
                        this.edit = false
                        alert('Successfully added a product!')
                        EventBus.$emit('refresh')
                    })
                    .catch((err) => {
                        alert('Cannot add this product.')
                    })
            },

            editProduct(id, formObj) {
                axios(
                    {
                        method: 'PUT',
                        url: 'api/update/' + id,
                        data: formObj,
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then((res) => {
                        this.product.name = ''
                        this.product.description = ''
                        this.product.price = 0
                        this.product.picture = false
                        this.edit = false
                        alert('Successfully edited a product!')  
                        EventBus.$emit('refresh')
                    })
                    .catch((err) => {
                        alert('Cannot edit this product.')
                    })
            },
 
            saveProduct() {
                var formData = new FormData()
                formData.append("name", this.product.name); 
                formData.append("price", this.product.price);
                formData.append("description", this.product.description)

                if (this.mode == 'add') {
                    formData.append("picture", this.product.picture)
                    this.createProduct(formData)
                } else {
                    this.editProduct(this.product.id, formData)
                }
            }
        }
    }
</script>