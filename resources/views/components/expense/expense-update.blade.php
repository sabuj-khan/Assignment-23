<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Expense</h5>
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
                    <button onclick="UpdateExpense()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>

    async function fillUpUpdateExpenseForm(id){
        document.getElementById('updateID').value = id;

        showLoader();
        let responsedata = await axios.post('/expense-by-id', {id:id});
        hideLoader();

        document.getElementById('updateAmount').value = responsedata.data['amount'];
        document.getElementById('updateDescription').value = responsedata.data['description'];
        document.getElementById('updateDate').value = responsedata.data['date'];
        document.getElementById('updateCategory').value = responsedata.data['category'];
    }



    async function UpdateExpense(){
        let amountup = document.getElementById("updateAmount").value;
        let descriptionup = document.getElementById("updateDescription").value;
        let dateup = document.getElementById("updateDate").value;
        let categoryup = document.getElementById("updateCategory").value;
        
        let update_id = document.getElementById("updateID").value;

        // const amountup = $("#updateAmount").val();
        // const descriptionup = $("#updateDescription").val();
        // const dateup = $("#updateDate").val();
        // const categoryup = $("#updateCategory").val();
        // const expense_id =$("#updateID").val();

        if(amountup.length === 0){
            errorToast("Expense amount is Required !")
        }else if(descriptionup.length === 0){
            errorToast("Expense description is Required !")
        }else if(dateup.length === 0){
            errorToast("Expense date is Required !")
        }else if(categoryup.length === 0){
            errorToast("Expense category is Required !")
        }else{

            document.getElementById("update-modal-close").click();

            let dataInfo = {
                "amount":amountup,
                "description":descriptionup,
                "date":dateup,
                "category":categoryup
            }

            showLoader();
            let response = await axios.post('/expense-update', dataInfo)
            hideLoader();

            if(response.status === 200 && response.data['status'] === 'success'){
                successToast('Expense item updated successfully');
                document.getElementById('update-form').reset();
                await gettingExpensesList();
            }else{
                errorToast("Request fail to update the expense");
            }
        }
    }

</script>