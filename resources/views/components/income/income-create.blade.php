<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Income</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Amount</label>
                                <input type="text" class="form-control" id="incomeAmount">

                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" id="description">

                                <label class="form-label">Income Date</label>
                                <input type="date" class="form-control" id="incomeDate">

                                <label class="form-label">Income Category</label>
                                <input type="text" class="form-control" id="incomeCategory">

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="CreateIncome()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>

<script>

    async function CreateIncome(){
        let amount = document.getElementById('incomeAmount').value;
        let description = document.getElementById('description').value;
        let date = document.getElementById('incomeDate').value;
        let category = document.getElementById('incomeCategory').value;

        if(amount.length === 0){
            errorToast('Income amount is required');
        }else if(description.length === 0){
            errorToast('Income Description is required');
        }else if(date.length === 0){
            errorToast('Income date is required');
        }else if(category.length === 0){
            errorToast('Income category is required');
        }else{
            document.getElementById('modal-close').click();
            let information = {
                amount:amount,
                description:description,
                date:date,
                category:category
            }

            showLoader();
            let  response = await axios.post('/income-create', information);
            hideLoader();

            if(response.status === 201 && response.data['status'] === 'success'){
                successToast('New income has been added successfully');
                document.getElementById("save-form").reset();
                await gettingIncomeList();
            }else{
                errorToast("Request fail and not added the income !")
            }


        }


    }

</script>