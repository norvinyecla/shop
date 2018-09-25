<template>
    <div class='row'>
        <form action="#" enctype="multipart/form-data" @submit.prevent="createProduct()">
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
                <fieldset>
                    <label>Picture</label>
                    <input v-on:change=onFileChange type="file" ref="picture" name="picture" class="form-control" autofocus>
                </fieldset>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">{{ message }}</button>
                </span>
            </div>
        </form>
    </div>
</template>

<script>
    import { EventBus } from '../event-bus.js'
    export default {
        data() {
            return {
                message: 'Create new product',
                product: {
                    name: '',
                    description: '',
                    price: 0,
                    picture: ''
                }
            };
        },
        
        created() {
            
        },
        
        methods: {
            onFileChange(e) {
                this.product.picture = this.$refs.picture.files[0];
            },
 
            createProduct() {
                var formData = new FormData()
                formData.append("name", this.product.name); 
                formData.append("price", this.product.price);
                formData.append("description", this.product.description);
                formData.append("picture", this.product.picture);
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
                        this.product.picture = null
                        this.edit = false
                        alert('Successfully added a product!')
                        EventBus.$emit('refresh')
                    })
                    .catch((err) => {
                        alert('Cannot add this product.')
                        err.response.data.errors.forEach(function (item, index) {
                            console.log(item)
                        })
                        console.log(warning)
                        
                    });
            }
        }
    }
</script>