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
                <tr class="list-group-item" v-for="(productObj, index) in list" :key="index">
                    <td style="border:1px solid black">
                        {{ productObj.id }}
                    </td>
                    <td style="border:1px solid black">
                        {{ productObj.name }}
                    </td>
                    <td style="border:1px solid black">
                        {{ productObj.picture }}
                    </td>
                    <td style="border:1px solid black">
                        {{ productObj.price }}
                    </td>
                    <td style="border:1px solid black">
                        {{ productObj.description }}
                    </td>
                    <td style="border:1px solid black">
                        <button @click="viewProduct(productObj.id)" class="btn btn-danger btn-xs pull-right">View</button>
                        <button @click="editProduct(productObj)" class="btn btn-danger btn-xs pull-right">Edit</button>
                        <button @click="deleteProduct(productObj.id)" class="btn btn-danger btn-xs pull-right">Delete</button>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <span>Showing {{ from }} to {{ to }} of {{ total }}</span>
            <br>
            <span>
                <a href="#" @click="fetchProductList(firstPageUrl)">First</a> | 
                <a href="#" @click="fetchProductList(prevPageUrl)">Previous</a> | 
                <a href="#" @click="fetchProductList(nextPageUrl)">Next</a> | 
                <a href="#" @click="fetchProductList(lastPageUrl)">Last</a>
            </span>
            
        </div>
        <div v-show="showForm">
            <product-form v-bind:product="product" v-bind:mode="mode"></product-form>
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
                product: {}
            }
        },
        
        created() {
            this.fetchProductList()

            EventBus.$on('refresh', () => {
                this.fetchProductList()
                this.showForm = false
            })

            EventBus.$on('hide_form', () => {
                this.showForm = false
                this.product.name = ''
                this.product.description = ''
                this.product.price = 0
                this.product.picture = false
            })
        },
        
        methods: {
            fetchProductList(target) {
                if (!target) {
                    target = 'products'
                }
                axios.get(target).then((res) => {
                    this.list = res.data.data

                    // pagination
                    this.currentPage = res.data.current_page
                    this.firstPageUrl = res.data.first_page_url
                    this.prevPageUrl = res.data.prev_page_url
                    this.nextPageUrl = res.data.next_page_url
                    this.lastPageUrl = res.data.last_page_url
                    this.from = res.data.from
                    this.to = res.data.to
                    this.total = res.data.total
                });
            },

            toggleCreateForm() {
                this.showForm = !this.showForm
                this.mode = "add"
            },

            editProduct(product) {
                this.showForm = true
                this.mode = "edit"
                this.product.id = product.id
                this.product.name = product.name
                this.product.price = product.price
                this.product.description = product.description
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
