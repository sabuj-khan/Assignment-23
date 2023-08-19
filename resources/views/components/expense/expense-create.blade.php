<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Expense</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Amount</label>
                                <input type="text" class="form-control" id="amount">

                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" id="description">

                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" id="date">

                                <label class="form-label">Category</label>
                                <input type="text" class="form-control" id="category">

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="AddingIncome()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>

    async function AddingIncome(){
        let amount = document.getElementById('amount').value;
        let description = document.getElementById('description').value;
        let date = document.getElementById('date').value;
        let category = document.getElementById('category').value;

        if(amount.length ===0){
            errorToast('Expense is required');
        }else if(description.length ===0){
            errorToast('Expense description is required');
        }else if(date.length ===0){
            errorToast('Expense date is required');
        }else if(category.length ===0){
            errorToast('Expense category is required');
        }else{
            document.getElementById('modal-close').click();
            let info = {
                amount:amount,
                description:description,
                date:date,
                category:category
            }
            showLoader();
            let response = await axios.post('/expense-create', info);
            hideLoader();

            if(response.status === 200 && response.data['status'] === 'success'){
                successToast('New Expense has been added successfully');
                document.getElementById('save-form').reset();
                await gettingExpensesList();
            }else{
                errorToast('Fail request to add new expense');
            }
        }
    }

</script>