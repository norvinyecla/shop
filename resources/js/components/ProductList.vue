<template>
    <div>
        <button @click="toggleCreateForm()">Create</button>
        <div class='row'>
            <span v-if='list.length === 0'>There are no products yet.</span> 
            <table v-else class="list-group">
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Picture
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Description
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                <tr class="list-group-item" v-for="(product, index) in list" :key="index">
                    <td style="border:1px solid black">
                        {{ product.id }}
                    </td>
                    <td style="border:1px solid black">
                        {{ product.name }}
                    </td>
                    <td style="border:1px solid black">
                        {{ product.picture }}
                    </td>
                    <td style="border:1px solid black">
                        {{ product.price }}
                    </td>
                    <td style="border:1px solid black">
                        {{ product.description }}
                    </td>
                    <td style="border:1px solid black">
                        <button @click="viewProduct(product.id)" class="btn btn-danger btn-xs pull-right">View</button>
                        <button @click="editProduct(product.id)" class="btn btn-danger btn-xs pull-right">Edit</button>
                        <button @click="deleteProduct(product.id)" class="btn btn-danger btn-xs pull-right">Delete</button>
                    </td>
                </tr>
            </table>
        </div>
        <div v-show="showForm">
            <product-form v-bind:id="id" v-bind:mode="mode"></product-form>
        </div>
    </div>
</template>

<script>
    import { EventBus } from '../event-bus.js'
    export default {
        data() {
            return {
                mode: 'add',
                list: [],
                showForm: false,
                id: 0,
            }
        },
        
        created() {
            this.fetchProductList()

            EventBus.$on('refresh', () => {
                this.fetchProductList()
                this.showForm = false
            })
        },
        
        methods: {
            fetchProductList() {
                axios.get('products').then((res) => {
                    this.list = res.data.data
                });
            },

            toggleCreateForm() {
                this.showForm = !this.showForm
                this.mode = "add"
            },

            editProduct(id) {
                this.mode = "edit"
                this.showForm = !this.showForm
                this.id = id
            },

            viewProduct(id) {
                location.href = 'view/' + id
            },
 
            deleteProduct(id) {
                if (confirm("Do you want to delete this product?") )
                {
                    axios.delete('api/delete/' + id)
                        .then((res) => {
                            this.fetchProductList()
                        })
                        .catch((err) => console.error(err));
                }
            },
        }
    }
</script>