<template>
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
</template>

<script>
    export default {
        data() {
            return {
                list: []
            };
        },
        
        created() {
            this.fetchProductList();
        },
        
        methods: {
            fetchProductList() {
                axios.get('products').then((res) => {
                    this.list = res.data.data;
                });
            },

            editProduct(id) {
                location.href = 'edit/' + id;
            },

            viewProduct(id) {
                location.href = 'view/' + id;
            },
 
            deleteProduct(id) {
                if (confirm("Do you want to delete this product?") )
                {
                    axios.delete('api/delete/' + id)
                        .then((res) => {
                            this.fetchProductList();
                        })
                        .catch((err) => console.error(err));
                }
            },
        }
    }
</script>