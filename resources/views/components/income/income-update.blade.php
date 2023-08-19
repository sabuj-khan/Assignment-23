<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Income</h5>
                </div>
                <div class="modal-body">
                    <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Amount</label>
                                <input type="text" class="form-control" id="updateAmount">

                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" id="updateDescription">

                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" id="updateDate">

                                <label class="form-label">Category</label>
                                <input type="text" class="form-control" id="updateCategory">

                                <input type="text" class="" id="updateID" placeholder="ID">

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="updateIncome()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>

    async function fillupUpdateIncomeForm(id){
        document.getElementById('updateID').value=id;

        showLoader();
        let info = await axios.post('/income-by-id', {id:id});
        hideLoader();

        document.getElementById('updateAmount').value=info.data['amount'];
        document.getElementById('updateDescription').value=info.data['description'];
        document.getElementById('updateDate').value=info.data['date'];
        document.getElementById('updateCategory').value=info.data['category'];
    }


    async function updateIncome(){
        let udAmount = document.getElementById('updateAmount').value;
        let udDescription = document.getElementById('updateDescription').value;
        let udDate = document.getElementById('updateDate').value;
        let udCategory = document.getElementById('updateCategory').value;

        if(udAmount.length === 0){
            errorToast('Income amount is required');
        }else if(udDescription.length === 0){
            errorToast('Income description is required');
        }else if(udDate.length === 0){
            errorToast('Income date is required');
        }else if(udCategory === 0){
            errorToast('Income category is required');
        }else{
            document.getElementById('update-modal-close').click();

            let incomeInfo = {
                'amount':udAmount,
                'description':udDescription,
                'date':udDate,
                'category':udCategory
            }

            showLoader();
            let udResponse = await axios.post('/income-update', incomeInfo);
            hideLoader();

            if(udResponse.status === 200 && udResponse.data['status'] === 'success'){
                successToast('Amader income update hosse thikmoto!');
                document.getElementById("update-form").reset();
                await gettingIncomeList();
            }else{
                errorToast('Income has not been updated');
            }
        }
    }




</script>