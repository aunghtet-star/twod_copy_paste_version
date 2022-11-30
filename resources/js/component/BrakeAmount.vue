<script>
import axios from "axios";
import { Modal } from 'bootstrap'

export default {
    name : "BrakeNumber",
    data() {
        return {
            brakeAmount : {}
        }
    },
    methods: {
        getData() {
            axios.get('/api/brake-amount').then(
                res => {
                    this.brakeAmount = res.data.brake_amount
                }
            )
        },
        updateData(){
            axios.post(`/api/brake-amount/${this.brakeAmount.id}`,this.brakeAmount).then(
                res => {
                    console.log('update')

                    let ModalInstance = document.getElementById('btn-close')
                    ModalInstance.click();
                }
            )

        }
    },
    mounted(){
        this.getData();

    }
}

</script>
<template>
    <div class="container">
        <div class="col-md-12">
            <h5 class="text-center my-3">Brake Number Page</h5>
            <div class="card shadow-sm">
                <div class="card-body" id="click">
                    <table class="table">
                        <thead>
                         <tr>
                             <th>စဉ်</th>
                             <th>Amount</th>
                             <th>Action</th>
                         </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td>1</td>
                              <td>{{ brakeAmount.amount }}</td>
                              <td>
                                  <a data-bs-toggle="modal" data-bs-target="#editModal" class="text-warning icons"><i class="fas fa-user-edit"></i></a>
                                  <!--                            <a href="" class="text-danger icons"><i class="fas fa-trash"></i></a>-->
                              </td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">ဘရိတ်ပမာဏပြောင်းရန်</h1>
                    <button type="button" class="btn-close" id="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Amount</label>
                        <input class="form-control" v-model="brakeAmount.amount">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ပိတ်မည်</button>
                    <button type="button" class="btn btn-primary" @click="updateData">ပြောင်းမည်</button>
                </div>
            </div>
        </div>
    </div>

</template>
