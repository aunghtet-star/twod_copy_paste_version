<template>
    <NavBar/>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow" >
                    <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Please Enter</label>
                                <textarea class="form-control" id="" v-model="two" name="twos" rows="15"></textarea>
                            </div>
                            <button @click="normalTwo" class="float-end btn btn-primary">Enter</button>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div  style="min-height: 80vh">
                    <div class="column mt-5" style="font-size: 15px">
                        <div class="span" v-for="(two,index) in overview" :key="index">
                            <span  class=" px-3" :class="two.total > brake_amount ? 'text-success' : ''" style="width: 20px">{{two.two}} - {{two.total}}</span>
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-between my-5">
                    <h5 class="">Total - {{ total}}</h5>
                    <button class="btn btn-danger" @click="clean">Clean</button>

                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-body">
                            ဖျက်မှာသေချာလား
                            <div class="mt-2 pt-2 border-top">
                                <button type="button" class="btn btn-primary btn-sm">Yes</button>
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">No</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<style>
.column {
    -webkit-column-count: 2; /* Chrome, Safari, Opera */
    -moz-column-count: 2; /* Firefox */
     column-count: 2;
    -webkit-column-gap: 40px; /* Chrome, Safari, Opera */
    -moz-column-gap: 40px; /* Firefox */
    column-gap: 40px;
}
.span {
    display: block;
}
</style>
<script>
import NavBar from './NavBar.vue'

export default {
    name: "NormalTwo",
    components: {NavBar},
    data() {
        return {
            two: '',
            overview : [],
            total : 0,
            brake_amount : ''
        }
    },
    methods: {
        normalTwo() {
            let two= this.two.split(/\r?\n|\r|\n/g);

            axios.post('/api/normal-two',two).then(
                res => {
                    this.sum();
                    this.two = ''
                }
            )


        },
        sum(){
            axios.get('/api/normal-two-overview').then(res => {
                this.overview = res.data.two_overview
                this.total = res.data.total
                this.brake_amount = res.data.brake_amount
                console.log(this.brake_amount)
                console.log(this.overview)
            })
        },
        clean(){

            Swal.fire({
                title: 'Are you sure?',
                text: "ဖျက်မှာသေချာလား",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ဖျက်မည်'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get('/api/normal-two-clean').then(
                        res => {
                            this.sum()
                            toast.fire({
                                icon: 'success',
                                title: 'ဖျက်ပြီးပါပြီ'
                            })
                        }
                    )
                }


            })

        }
    },
    created() {
        this.sum()
    }

}
</script>

<style scoped>

</style>
