$(document).ready(function(){
    
    // load/fetch data
    function loadData(){
        $("#tableData").html("");
        $.ajax({
            url:"http://localhost/REST_API_PROJECT/REST_API/rest-api-fetch-all.php",
            type:"GET",
            success:function(data){
                $.each(data, function(key, value){
                    $("#tableData").append(" <tr>"+"<td>"+value.id+"</td>"+"<td>"+value.student_name+"</td>"+"<td>"+value.age+"</td>"+"<td>"+value.city+"</td>"+"<td class='text-center'>"+"<button class='btn btn-success me-3' id='editButton' data-eid="+value.id+">Edit</button>"+"<button class='btn btn-danger' data-id="+value.id+" id='deleteButton'>Delete</button>"+"</td>"+"</tr>");
                });
            }
        });
    }
    loadData();

    // show modal box
    $(document).on('click',"#editButton",function(){
        $(".modalBox").css("display","flex");
        var editId = $(this).data('eid');
        var obj = {sid:editId}
        var json = JSON.stringify(obj);
        $.ajax({
            url:"http://localhost/REST_API_PROJECT/REST_API/rest-api-fetch-single.php",
            type:"POST",
            data:json,
            success:function(data){
                $("#editId").val(data[0].id);
                $("#editname").val(data[0].student_name);
                $("#editage").val(data[0].age);
                $("#editcity").val(data[0].city);
            }
        })
    });

    // hide modal box
    $(document).on('click',".fa-xmark",function(){
        $(".modalBox").css("display","none");
    });

    // update data
    $("#editButton").on('click',function(event){
        event.preventDefault();
        var obj = {
            id:$("#editId").val(),
            name:$("#editname").val(),
            age:$("#editage").val(),
            city:$("#editcity").val(),
        }
        var objJSON = JSON.stringify(obj);
        $.ajax({
            url:"http://localhost/REST_API_PROJECT/REST_API/rest-api-update.php",
            type:"PUT",
            data:objJSON,
            success:function(data){
                if(data.status == true){
                    $(".modalBox").css("display","none");
                    loadData();
                    alert(data.message);
                }else if(data.status == false){
                    alert(data.message);
                }
            }
        })
    });
    // insert data
    $("#submit").on('click',function(event){
        event.preventDefault();
        var obj = {
            name:$("#name").val(),
            age:$("#age").val(),
            city:$("#city").val(),
        }
        var objJSON = JSON.stringify(obj);
        $.ajax({
            url:"http://localhost/REST_API_PROJECT/REST_API/rest-api-insert.php",
            type:"POST",
            data:objJSON,
            success:function(data){
                if(data.status == true){
                    $(".modalBox").css("display","none");
                    loadData();
                    $("#name").val(''),
                    $("#age").val(''),
                    $("#city").val(''),
                    alert(data.message);
                }else if(data.status == false){
                    alert(data.message);
                }
            }
        });
    });

    // delete record
    $(document).on('click','#deleteButton',function(event){
        event.preventDefault();
        var id = $(this).data('id');
        var obj = {deleteId : id};
        var objJSON = JSON.stringify(obj);
        $.ajax({
            url:"http://localhost/REST_API_PROJECT/REST_API/rest-api-delete.php",
            type:"POST",
            data:objJSON,
            success:function(data){
                if(data.status == true){
                    alert(data.message);
                    loadData();
                }else if (data.status == false){
                    alert(data.message);
                }
            }
        });
    });

    $("#search").on("keyup",function(){
        var searchVal = $(this).val();
         $("#tableData").html("");
        $.ajax({
            url:"http://localhost/REST_API_PROJECT/REST_API/rest-api-search.php?search=" + searchVal,
            type:'GET',
            success:function(data){
                $.each(data, function(key, value){
                    $("#tableData").append(" <tr>"+"<td>"+value.id+"</td>"+"<td>"+value.student_name+"</td>"+"<td>"+value.age+"</td>"+"<td>"+value.city+"</td>"+"<td class='text-center'>"+"<button class='btn btn-success me-3' id='editButton' data-eid="+value.id+">Edit</button>"+"<button class='btn btn-danger' data-id="+value.id+" id='deleteButton'>Delete</button>"+"</td>"+"</tr>");
                });
            }
        });
    })

})