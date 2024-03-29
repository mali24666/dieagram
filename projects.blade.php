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
    .pluse {
        position:relative ;
        background-color: red;

    }
    .new-move {
        position:absolute ;
        /* background-color: gray; */
        border-style: solid;
        /* top: 120px;
        left: 10px; */
    }
    .drop-down {
        display: none ;
        background-color: rgb(248, 251, 248);
         position:absolute ;
    }
    hr {
        border: 2px solid red;
        border-radius: 50px;
        }
        .vl {
        border-left: 6px solid green;
        height: 220px;
        position: absolute;
        left: 50%;
        margin-left: -3px;
        top: 0;
        }
        .hl {
            display: block;
            border-top:  6px solid green;
            position: absolute;
            width: 150px

        }

    </style> 
</head>
<body>
  
    <div class="container">
        <h2 class="text-center mt-5 mb-3">dieagram </h2>
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
                    <input  name="update_id" id="update_id">
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
                        <select class="form-control {{ $errors->has('station') ? 'is-invalid' : '' }}" name="station" id="station">
                            <option value disabled {{ old('station', null) === null ? 'selected' : '' }}>station</option>
                            @foreach(App\Models\project::typeSelecy as $key => $label)
                                <option value="{{ $key }}" {{ old('station', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>        
                        {{-- <input type="text" class="form-control" id="station" name="station"> --}}
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

                        let showBtn =  '<button ' +
                            ' class="btn btn-outline-info" ' +
                            ' onclick="showProject(' + projects[i].id + ')">Show' +
                        '</button> ';
                        let editBtn =  '<button ' +
                            ' class="btn btn-outline-success" ' +
                            ' onclick="editProject(' + projects[i].id + ')">' +
                            '<i class = "glyphicon glyphicon-pencil"></i>'+
                        '</button> ';
                        let addWright = 
                            '<button ' +
                            ' class="btn btn-outline-success" ' +
                            ' onclick="addwrite(' + projects[i].id + ')">' +
                            '<i class = "glyphicon glyphicon-arrow-right"></i>'+
                            '</button> ';
                        let addDown =  '<button ' +
                            ' class="btn btn-outline-success" ' +
                            ' onclick="addDown(' + projects[i].id + ')">' +
                            '<i class = "glyphicon glyphicon-arrow-down"></i>'+
                        '</button> ';
                        
                        let deleteBtn =  '<button ' +
                            ' class="btn btn-outline-danger " ' +
                            ' onclick="destroyProject(' + projects[i].id + ')">' +
                            '<i class = "glyphicon glyphicon-trash"></i>'+
                        '</button>';
                        let add =  '<i ' +
                            ' class=" 	glyphicon glyphicon-option-vertical pluse" ' +
                            ' >' +
                            '</i>';
                       let dropdown =     '<div class="drop-down text-center" >'+
                                            '<spam  >'+addWright+'</spam>'+
                                            '<spam  >'+addDown+'</spam>'+
                                            '<spam  >'+editBtn+'</spam>'+
                                            '<spam  >'+deleteBtn+'</spam>'+
                                           '</div>' ;
                        var m = projects[i].station;
                        if (m==2) {
                            let projectRow = 
                            '<div class="vl text-center " id="move2"><div  >'+'<br>'+'<br>' + projects[i].name +'<br>'+ add + dropdown+'</div></div>' ;
                            var x = projects[i].top ;
                        var y =  projects[i].left ;

                                $("#projects-table-body") .append( $(projectRow) .attr("id", "id_" + i) .offset({top:x , left:y}) );  
                                $('.move').hide();

                        }
                        else  if   (m==3) {
                            let projectRow = 
                            '<div class="hl " id="move3"><div  >' + projects[i].name + add + dropdown+'</div></div>' ;
                            var x = projects[i].top ;
                        var y =  projects[i].left ;

                                $("#projects-table-body") .append( $(projectRow) .attr("id", "id_" + i) .offset({top:x , left:y}) );  
                                $('.move').hide();

                        }


                         else {
                            let projectRow = 
                            '<div class="move " id="move"><hr><div  >' + projects[i].name + add + dropdown+'</div></div>' 
                            // '<td>' + projects[i].top + '</td>' +
                            // '<td>' + projects[i].left + '</td>' +
                            // '<td>' + projects[i].station + '</td>' +
                            // '<td>' + projects[i].description + '</td>' +
                            // '<td>' + showBtn + editBtn + deleteBtn + '</td>' +
                        ;
                        var x = projects[i].top ;
                        var y =  projects[i].left ;

                                $("#projects-table-body") .append(projectRow , $(projectRow) .attr("id", "id_" + i) .attr("class",'new-move').offset({top:x , left:y}) );  
                                $('.move').hide();

                        }
                        
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


                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }

        /*
            check if form submitted is for creating or updating
        */
        $("#save-project-btn").click(function(event ){
            event.preventDefault();
            if($("#update_id").val() == null || $("#update_id").val() == "" || $("#update_id").val() == "addwrite")
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
                    $("#top").val(project.top);
                    $("#left").val(project.left);
                    $("#station").val(project.station);
                    $("#description").val(project.description);
                    $("#form-modal").modal('show'); 
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
     
                /*
        اضافة عنصر باتجاه اليمين بطريقة التعديل علي العنصر السابق 
                */
        function addwrite(id)
        {
            console.log("addwrite");
            let url = $('meta[name=app-url]').attr("content") + "/projects/" + id ;
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let project = response.project;
                    let y = project.left ;
                    let newY =parseInt(y) +60;
                    $("#alert-div").html("");
                    $("#error-div").html("");   
                    $("#update_id").val("addwrite");
                    $("#name").val(project.name);
                    $("#station").val(project.station);
                    if (project.station==2) {
                        let y = project.left ;
                        let newY =parseInt(y) ;
                        let x = project.top ;
                        let newx =parseInt(x) +150;
                        $("#top").val(newx);

                        $("#left").val(newY);
                        console.log('2');
                    }
                  else  if (project.station==3) {
                        let y = project.left ;
                        let newY =parseInt(y) +250;
                        $("#left").val(newY);
                        $("#top").val(project.top);
                        console.log('3');

                    }

                    else {
                        let y = project.left ;
                        let newY2 =parseInt(y) +50;
                        $("#left").val(newY2);
                        $("#top").val(project.top);
                        console.log('else');

                    }

                    $("#description").val(project.description);
                    $("#form-modal").modal('show'); 
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
                /*
        اضافة عنصر للاسفل  بطريقة التعديل علي العنصر السابق 
                */
                function addDown(id)
        {
            console.log("addwrite");
            let url = $('meta[name=app-url]').attr("content") + "/projects/" + id ;
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let project = response.project;
                    // let y = project.top ;
                    // let newY =parseInt(y) +100;
                    $("#alert-div").html("");
                    $("#error-div").html("");   
                    $("#update_id").val("addwrite");
                    $("#name").val(project.name);
                    $("#left").val(project.left);
                    $("#station").val(project.station);
                    if (project.station==2) {
                        let y = project.top ;
                        let newY =parseInt(y) +220;
                        $("#top").val(newY);
                    }
                  else  if (project.station==3) {
                        let y = project.top ;
                        let newY =parseInt(y) +0;
                        $("#top").val(newY);
                    }

                    else {
                        let y = project.top ;
                        let newY2 =parseInt(y) +50;
                        $("#top").val(newY2);

                    }
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
                top: $("#top").val(),
                left: $("#left").val(),
                station: $("#station").val(),

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
                    $("#top").val("");
                    $("#left").val("");
                    $("#station").val("");
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