<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laravel Project Manager</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ url('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

   <style>
    .move {
        position: relative; 
        background-color: rgb(192, 176, 39);
    }
    .pluse {
        position:relative ;
        background-color: red;

    }
    .new-move {
        position:absolute ;

        /* top: 120px;
        left: 10px; */
    }
    .drop-down {
        display: none ;
        background-color: rgb(215, 159, 188);
         position:absolute ;
    }
    </style> 
</head>
<body>
  
    <div class="container">
        <h2 class="text-center mt-5 mb-3">Laravel Project Manager</h2>
        <div class="card">

            <div class="card-header">
                <button class="btn btn-outline-primary" onclick="createProject()"> 
                    ok
                </button>
            </div>
            <div class="card-body">
                <div id="alert-div">
                 
                </div>
                <div  id="projects-table-body">
                    <div class="move" id="show"></div>

                </div>
                {{-- <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>top</th>
                            <th>left</th>
                            <th>station</th>
                            <th>Description</th>
                            <th width="240px">Action</th>
                        </tr>
                    </thead>
                    <tbody id="projects-table-body">
                         
                    </tbody>
                     
                </table> --}}
            </div>
        </div>
    </div>
  
    <!-- modal for creating and editing function -->
    <div class="modal" tabindex="-1"  id="form-modal">
        <div class="modal-dialog" >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Project Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="error-div"></div>
                <form>
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="top">top</label>
                        <input type="text" class="form-control" id="top" name="top">
                    </div>
                    <div class="form-group">
                        <label for="left">left</label>
                        <input type="text" class="form-control" id="left" name="left">
                    </div>
                    <div class="form-group">
                        <label for="station">station</label>
                        <input type="text" class="form-control" id="station" name="station">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                    </div>
                 
                    <button type="submit" class="btn btn-outline-primary mt-3" id="save-project-btn">Save Project</button>
                </form>
            </div>
            </div>
        </div>
    </div>
 
    <!-- view record modal -->
    <div class="modal" tabindex="-1" id="view-modal">
        <div class="modal-dialog" >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Project Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <b>Name:</b>
                <p id="name-info"></p>
                <b>top:</b>
                <p id="top-info"></p>
                <b>left:</b>
                <p id="left-info"></p>
                <b>station:</b>
                <p id="station-info"></p>
                <b>Description:</b>
                <p id="description-info"></p>
            </div>
            </div>
        </div>
    </div>
  
    <script type="text/javascript">
  
        showAllProjects();
        /*
            This function will get all the project records
        */
        //     $(window).click(function(e) {
        //     // console.log("widow");
        //     $(".drop-down").hide();
        // });

//         $('body').click(function(evt){    
//        if(evt.target.id == "drop")
//           console.log("hellow");;
//        //For descendants of menu_content being clicked, remove this check if you do not want to put constraint on descendants.
//        if($(evt.target).closest('.pluse').length)
//           console.log("second one");;             

//       //Do processing of click event here for every element except with id menu_content

// });



        function showAllProjects()
        {
            let url = $('meta[name=app-url]').attr("content") + "/projects";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    $("#projects-table-body").html("");
                    let projects = response.projects;
                    for (var i = 0; i < projects.length; i++) 
                    {
                        var nameid = projects[i].id;

                        // let showBtn =  '<button ' +
                        //     ' class="btn btn-outline-info" ' +
                        //     ' onclick="showProject(' + projects[i].id + ')">Show' +
                        // '</button> ';
                        // let editBtn =  '<button ' +
                        //     ' class="btn btn-outline-success" ' +
                        //     ' onclick="editProject(' + projects[i].id + ')">Edit' +
                        // '</button> ';
                        let deleteBtn =  '<button ' +
                            ' class="btn btn-outline-danger drop-down" ' +
                            ' onclick="destroyProject(' + projects[i].id + ')">-' +
                        '</button>';
                        let add =  '<i ' +
                            ' class=" 	glyphicon glyphicon-option-vertical pluse" ' +
                            ' >' +projects[i].top+
                            '</i>';
                       let dropdown =     '<div class="drop-down" >'+
                                            '<li class="add" value="+projects[i].top+"></li>'+

                                        '</div>' ;

                        let projectRow = 
                            '<div class="move" id="move"><hr><div  >' + projects[i].name + add + dropdown+'</div></div>' 
                            // '<td>' + projects[i].top + '</td>' +
                            // '<td>' + projects[i].left + '</td>' +
                            // '<td>' + projects[i].station + '</td>' +
                            // '<td>' + projects[i].description + '</td>' +
                            // '<td>' + showBtn + editBtn + deleteBtn + '</td>' +
                        ;
                        
                        var x = projects[i].top ;
                        var y =  projects[i].left ;
                        // var x =[ projects[i].top ,
                        //         projects[i].left
                        //         ] ;
                                $("#projects-table-body") .append(projectRow , $(projectRow) .attr("id", "id_" + i) .attr("class",'new-move').offset({top:x , left:y}) );  
                                $('.move').hide();
                        // $("#projects-table-body").each(function(i, e){
                        //     $(this).append(projectRow);
                        //     $(projectRow) .offset({top:x , left:y});
                        //     .attr("id", "id_" + i);
                        // });
                        
                        // $("#projects-table-body").appendTo('.pluse'
                        //     );
                            
                        // $(this).offset({top:x , left:y});

                        // var x = '';
                        // var y = '';

                    }
                    $(".pluse").click(function (e) { 
                        e.preventDefault();
                        $(this).siblings(".drop-down").toggle();

                                            // Close the dropdown menu if the user clicks outside of it
                        window.onclick = function(event) {
                        if (!event.target.matches('.pluse')) {
                            var dropdowns = document.getElementsByClassName("drop-down");
                            var i;
                            for (i = 0; i < dropdowns.length; i++) {
                            var openDropdown = dropdowns[i];
                            $(".drop-down").hide();
                            if (openDropdown.classList.contains('show')) {
                                openDropdown.classList.remove('show');
                            }
                            }
                        }
                        }

                    });

                    $(".add").click(function (e) { 
                        e.preventDefault();
                        var X = $(this).html();
                        console.log(X);

                        var offset = $(this).offset();

                        
                        var top = offset.top-93.7;
                        var left = offset.left-100;
                        $("#alert-div").html("");
                        $("#error-div").html("");   
                        $("#update_id").val("");
                        $("#name").val("");
                        $("#top").val(top);
                        $("#left").val(left);
                        $("#station").val("");
                        $("#description").val("");
                        $("#form-modal").modal('show'); 

                    });

                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
        function move(x)
        {
           var y= x[0];
            var z= x[1];
            console.log('y'+'='+y);
            console.log(z);
            //  $('.move').attr("id", "id_" + i)
            //                 .appendTo(this);
            // var offset = $('#move').offset();
            // var top = offset.top;
            // var left = offset.left;
            // console.log("top="+top ,'left ='+left);

            // $('#move').offset({top:0 , left:0});
            // $('#move').offset({top: y , left: z});


            console.log("new top="+top ,'left ='+left);

            // $(this).offset({top:110 , left:100});

        }

        /*
            check if form submitted is for creating or updating
        */
        $("#save-project-btn").click(function(event ){
            event.preventDefault();
            if($("#update_id").val() == null || $("#update_id").val() == "")
            {
                storeProject();
            } else {
                updateProject();
            }
        })
     
        /*
            show modal for creating a record and 
            empty the values of form and remove existing alerts
        */
        function createProject()
        {
            $("#alert-div").html("");
            $("#error-div").html("");   
            $("#update_id").val("");
            $("#name").val("");
            $("#top").val("");
            $("#left").val("");
            $("#station").val("");
            $("#description").val("");
            $("#form-modal").modal('show'); 
        }
        // اضافة عنصر جديد مع اخذ الاحجاثية 
        function add()
        {
                        var offset = $(this).offset();
                        var top = offset.top-120;
                        var left = offset.left-10;
                        console.log(top);
                        $("#alert-div").html("");
                        $("#error-div").html("");   
                        $("#update_id").val("");
                        $("#name").val("");
                        $("#top").val(top);
                        $("#left").val(left);
                        $("#station").val("");
                        $("#description").val("");
                        $("#form-modal").modal('show'); 
                }
        /*
            submit the form and will be stored to the database
        */
        function storeProject()
        {   
            $("#save-project-btn").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/projects";
            let data = {
                name: $("#name").val(),
                top: $("#top").val(),
                left: $("#left").val(),
                station: $("#station").val(),
                description: $("#description").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    $("#save-project-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert"><b>Project Created Successfully</b></div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#top").val("");
                    $("#left").val("");
                    $("#station").val("");
                    $("#description").val("");
                    showAllProjects();
                    $("#form-modal").modal('hide');
                },
                error: function(response) {
                    $("#save-project-btn").prop('disabled', false);
     
                    /*
        show validation error
                    */
                    if (typeof response.responseJSON.errors !== 'undefined') 
                    {
        let errors = response.responseJSON.errors;
        let descriptionValidation = "";
        if (typeof errors.description !== 'undefined') 
                        {
                            descriptionValidation = '<li>' + errors.description[0] + '</li>';
                        }
                        let nameValidation = "";
        if (typeof errors.name !== 'undefined') 
                        {
                            nameValidation = '<li>' + errors.name[0] + '</li>';
                        }
         
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + nameValidation + descriptionValidation + '</ul>' +
        '</div>';
        $("#error-div").html(errorHtml);        
    }
                }
            });
        }
     
     
        /*
            edit record function
            it will get the existing value and show the project form
        */
        function editProject(id)
        {
            let url = $('meta[name=app-url]').attr("content") + "/projects/" + id ;
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let project = response.project;
                    $("#alert-div").html("");
                    $("#error-div").html("");   
                    $("#update_id").val(project.id);
                    $("#name").val(project.name);
                    $("#description").val(project.description);
                    $("#form-modal").modal('show'); 
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
     
        /*
            sumbit the form and will update a record
        */
        function updateProject()
        {
            $("#save-project-btn").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/projects/" + $("#update_id").val();
            let data = {
                id: $("#update_id").val(),
                name: $("#name").val(),
                description: $("#description").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "PUT",
                data: data,
                success: function(response) {
                    $("#save-project-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert"><b>Project Updated Successfully</b></div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#description").val("");
                    showAllProjects();
                    $("#form-modal").modal('hide');
                },
                error: function(response) {
                    /*
        show validation error
                    */
                    $("#save-project-btn").prop('disabled', false);
                    if (typeof response.responseJSON.errors !== 'undefined') 
                    {
                        console.log(response)
        let errors = response.responseJSON.errors;
        let descriptionValidation = "";
        if (typeof errors.description !== 'undefined') 
                        {
                            descriptionValidation = '<li>' + errors.description[0] + '</li>';
                        }
                        let nameValidation = "";
        if (typeof errors.name !== 'undefined') 
                        {
                            nameValidation = '<li>' + errors.name[0] + '</li>';
                        }
         
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + nameValidation + descriptionValidation + '</ul>' +
        '</div>';
        $("#error-div").html(errorHtml);        
    }
                }
            });
        }
     
        /*
            get and display the record info on modal
        */
        function showProject(id)
        {
            $("#name-info").html("");
            $("#description-info").html("");
            let url = $('meta[name=app-url]').attr("content") + "/projects/" + id +"";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let project = response.project;
                    $("#name-info").html(project.name);
    $("#description-info").html(project.description);
    $("#view-modal").modal('show'); 
     
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
     
        /*
            delete record function
        */
        function destroyProject(id)
        {
            let url = $('meta[name=app-url]').attr("content") + "/projects/" + id;
            let data = {
                name: $("#name").val(),
                description: $("#description").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "DELETE",
                data: data,
                success: function(response) {
                    let successHtml = '<div class="alert alert-success" role="alert"><b>Project Deleted Successfully</b></div>';
                    $("#alert-div").html(successHtml);
                    showAllProjects();
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
     
    </script>
</body>
</html>