
$(document).ready(function() {
 

    $('#country').on('change', function() {
        var country_id = $("#country").val(); 
        $('#state').val(""); 
        $('#city').append('<option value="">Select a city</option>');   
        $('#state').prop('disabled', false);
        $.ajax({
            url: 'master/dependent_data.php', 
            method: 'POST', 
            data: { country_id: country_id , dependent :"country"},
            dataType: 'json',
            success: function(response) {
                var stateSelect = $("#state"); 
                stateSelect.empty(); 
                stateSelect.append('<option value="">Select a state</option>'); 
    
                $.each(response, function(index, state) {
                    stateSelect.append('<option value="' + state.id + '">' + state.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error("Error fetching states: ", error); 
            }
        });
    });

    $('#state').on('change', function() {
        var state_id = $("#state").val(); 
        $('#city').val("");  
        $('#city').prop('disabled', false);
        $.ajax({
            url: 'master/dependent_data.php', 
            method: 'POST', 
            data: { state_id: state_id , dependent :"state"},
            dataType: 'json',
            success: function(response) {
                var citySelect = $("#city"); 
                citySelect.empty(); 
                citySelect.append('<option value="">Select a city</option>'); 
    
                $.each(response, function(index, city) {
                    citySelect.append('<option value="' + city.id + '">' + city.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error("Error fetching states: ", error); 
            }
        });
    });

    var dependentData = ''; 

$("#dependent_formData").on('submit', function(event) {
    event.preventDefault();
    dependentData = $(this).serialize(); 
    $("#personal_formData").show();  
    $(this).hide();
});

$("#personal_formData").on('submit', function(event) {
    event.preventDefault();
    
    var personalData = $(this).serialize();
    var combinedData = dependentData + '&' + personalData;

    $.ajax({
        url: 'master/insert_master.php', 
        method: 'POST', 
        data: combinedData,
        dataType: 'json',
        success: function(status) {
            if (status.status == true) {
                window.location.href = "index.php";
            } else {
                alert("Error occurred");
            }
        },
    });
});

// edit data 

 var dependentEditData = '';
$("#dependent_editData").on('submit', function(event) {
    event.preventDefault();
    dependentEditData = $(this).serialize(); 
    $("#personal_editData").show();  
    $(this).hide();
});

$("#personal_editData").on('submit', function(event) {
    event.preventDefault();

    var personalEditData = $(this).serialize();
    var combinedEditData = dependentEditData + '&' + personalEditData;
    console.log(combinedEditData);
    $.ajax({
        url: 'master/update_master.php', 
        method: 'POST', 
        data: combinedEditData,
        dataType: 'json',
        success: function(status) {
            if (status.status == true) {
                window.location.href = "index.php";
            } else {
                alert("Error occurred");
            }
        },
    });
});



});
function deleteRecord(id) {
    var flag = confirm('Are you sure you want to delete this record?');
    if(flag){
        $.ajax({
            url: 'master/delete_master.php', 
            method: 'POST', 
            data: {id: id},
            dataType: 'json',
            success: function(status) {
                if (status.status == true) {
                    alert("Your record is deleted");
                    $("#userTable").DataTable().destroy();
                    $("#" + id)
                        .closest("tr")
                        .remove();
                        $('#userTable').DataTable();
        
                } else {
                    alert("Error occurred");
                }
            },
        });
    }
}
