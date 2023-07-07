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

    }
    img {
        border: 1px solid #ddd;
            border-radius: 4px;
            width: 50px; 
            position:absolute ;
 
            }
            .ct-0 {
        position:absolute ;
        border: solid 4px red;

    }

    .ct {
        position:absolute ;
        border: solid 4px green;

    }
    .new-move {
        position:absolute ;
        /* background-color: gray; */
        /* border: solid 2px green; */
        /* top: 120px;
        left: 10px; */
    }
    #station-select {

        display: none ;

    }
    #transe-select {

    display: none ;

    }
    #ct-select , #feeder-select {

    display: none ;

    }
    .drop-down {
        display: none ;
        background-color: rgb(248, 251, 248);
         position:absolute ;
    }
    /* hr {
        border: 2px solid red;
        border-radius: 50px;
        } */
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
            width: 250px

        }
        /* #transefer_id_id [
        display: none ;
        ] */

    </style> 
</head>
<body>
          @can('diagram_access')

    <div class="container">
        <h2 class="text-center mt-5 mb-3">dieagram </h2>
        <div class="card">

            <div class="card-header">
                <button class="btn btn-outline-primary" > 
                        <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                            out  
                        </a>
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
                    <div class="form-group">
                    <input  name="update_id" id="update_id">
                </div>

                    <div class="form-group">
                        <label for="top">top</label>
                        <input type="text" class="form-control" id="top" name="top">
                    </div>
                    {{-- left  --}}
                    <div class="form-group">
                        <label for="left">left</label>
                        <input type="text" class="form-control" id="left" name="left">
                    </div>
                    {{-- feeder --}}
                    <div class="form-group feeder_main">
                        <label for="feeder">feeder </label>
                        <input type="text" class="form-control" id="feeder_id" name="feeder_id">
                    </div>
                    {{-- second_feeder --}}
                    <div class="form-group">
                        <label for="second_feeder">second_feeder</label>
                        <input type="text" class="form-control" id="second_feeder" name="second_feeder">
                    </div>
                
                    {{-- station --}}
                    <div class="form-group">
                        <label for="station">station</label>
                        <select class="form-control {{ $errors->has('station') ? 'is-invalid' : '' }} selectpicker" name="station" id="station" data-live-search="true">
                            <option value disabled {{ old('station', null) === null ? 'selected' : '' }}>station</option>
                            @foreach(App\Models\project::typeSelecy as $key => $label)
                                <option value="{{ $key }}" {{ old('station', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>        
                    </div>
                    <div class="form-group"  id="station-select">
                        <label for="name">station</label>
                        <select data-live-search="true" name="name " id="name" class="show-dropdown "></select>
                    </div>
                    {{-- transefer_id --}}
                    <div class="form-group"  id="transe-select">
                        <label for="transefer_id">transefer_id</label>
                        <select name="transefer_id " id="transefer_id" class="transe-how-dropdown  " ></select>
                        <button class="btn btn-outline-primary" > 
                            <a class="nav-link {{ request()->url("admin/transeformers/create") ? "active" : "" }}" href="{{ url("admin/transeformers/create") }}">
                                add ct   
                            </a>
                        </button>
                    </div>
                    {{-- ct_id --}}
                    <div class="form-group"  id="ct-select">
                        <label for="ct">ct</label>
                        <select name="ct_id " id="ct_id" class="ct-show-dropdown " ></select>
                        <button class="btn btn-outline-primary" > 
                            <a class="nav-link {{ request()->url("admin/cts/create") ? "active" : "" }}" href="{{ url("admin/cts/create") }}">
                                add ct_id   
                            </a>
                        </button>
                        {{-- ct_postion --}}
                        <div class="form-group">
                            <label for="ct_postion">CT status</label>
                            <select name="ct_postion " id="ct_postion" >
                                <option value="0">off</option>
                                <option value="1">on</option>
                            </select>
                        </div>
                    </div>
                    {{-- feeder --}}
                    <div class="form-group" id="feeder-select">
                        <div class="form-group">
                            <label for="feeder">feeder </label>
                            <select class="form-control feeder-show-dropdown  select2 {{ $errors->has('feeder') ? 'is-invalid' : '' }}" name="feeder_id" id="feeder_id">
                            </select>
                            </div>
                    </div>
                    {{-- rmu_id --}}
                    <div class="form-group  " id ="rmu_id_select">
                        <label for="rmu_id">{{ trans('cruds.project.fields.rmu') }}</label>
                        <select class="form-control select2 {{ $errors->has('rmu') ? 'is-invalid' : '' }}" name="rmu_id" id="rmu_id">
                        </select>
                        @if($errors->has('rmu'))
                            <span class="text-danger">{{ $errors->first('rmu') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.project.fields.rmu_helper') }}</span>
                    </div>
                    {{-- autorecloser_id --}}
                    <div class="form-group" id ="autorecloser_id_select">>
                        <label for="autorecloser_id">{{ trans('cruds.project.fields.autorecloser') }}</label>
                        <select class="form-control select2 {{ $errors->has('autorecloser') ? 'is-invalid' : '' }}" name="autorecloser_id" id="autorecloser_id">
                        </select>
                        @if($errors->has('autorecloser'))
                            <span class="text-danger">{{ $errors->first('autorecloser') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.project.fields.autorecloser_helper') }}</span>
                    </div>
                    {{-- sectionlazy_id --}}
                    <div class="form-group" id ="sectionlazy_id_select">>
                        <label for="sectionlazy_id">{{ trans('cruds.project.fields.sectionlazy') }}</label>
                        <select class="form-control select2 {{ $errors->has('sectionlazy') ? 'is-invalid' : '' }}" name="sectionlazy_id" id="sectionlazy_id">
                        </select>
                        @if($errors->has('sectionlazy'))
                            <span class="text-danger">{{ $errors->first('sectionlazy') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.project.fields.sectionlazy_helper') }}</span>
                    </div>
                    {{-- avr_id --}}
                    <div class="form-group" id ="avr_id_select">>
                        <label for="avr_id">{{ trans('cruds.project.fields.avr') }}</label>
                        <select class="form-control select2 {{ $errors->has('avr') ? 'is-invalid' : '' }}" name="avr_id" id="avr_id">
                        </select>
                        @if($errors->has('avr'))
                            <span class="text-danger">{{ $errors->first('avr') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.project.fields.avr_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="descreption">descreption</label>
                        <textarea class="form-control" id="descreption" rows="3" name="descreption"></textarea>
                    </div>
                {{-- </div> --}}

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
                <b>descreption:</b>
                <p id="descreption-info"></p>
                <b>transefer_id:</b>
                <p id="transefer_id"></p>

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
                    let transformer =  response.transformer;
                    let feeder =  response.feeder;
                    let cts = response.cts;
                    // console.log(t_no);

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
                        if (m==2) { // اذا كان الخط عامودي 
                            let feedername = projects[i].feeder_id ;  
                            let urlfeeder = $('meta[name=app-url]').attr("content") + "/admin/line/fetchfeeder/" + feedername +"";
 
                                for (var i2 = 0; i2 < feeder.length; i2++) 
                                {  if (feedername == feeder[i2].id ) {
                                    let projectRow = 
                                    '<div class="vl text-center " id="move2"><div  >'+'<br>'+'<br>'+'<br>'+'<br>' + '<a  href="'+ urlfeeder +'">' +feeder[i2].line_no  +' </a>' +'<br>'+ add + dropdown+'</div></div>' ;
                                    var x = projects[i].top ;
                                    var y =  projects[i].left ;
                                    $("#projects-table-body") .append( $(projectRow) .attr("id", "id_" + i) .offset({top:x , left:y}) );  
                                    $('.move').hide();

                                }
                                }

                        }
                        else  if   (m==3) { // اذا كان الخط افقي 
                            console.log(response);
                            let feedername = projects[i].feeder_id ;   
                            let urlfeeder = $('meta[name=app-url]').attr("content") + "/admin/line/fetchfeeder/" + feedername +"";

                                for (var i2 = 0; i2 < feeder.length; i2++) 
                                {
                                    if (feedername == feeder[i2].id ) {
                                        console.log(feedername);
                                        let projectRow = 
                                        '<div class="hl " id="move3"><div  >' +'<a  href="'+ urlfeeder +'">' +feeder[i2].line_no  +' </a>' + add + dropdown+'</div></div>' ;
                                        var x = projects[i].top ;
                                        var y =  projects[i].left ;
                                        $("#projects-table-body") .append( $(projectRow) .attr("id", "id_" + i) .offset({top:x , left:y}) );  
                                        $('.move').hide();

                                    }
                                }
                        }
                        else  if   (m==1) { // اذا كان النوع محطه  power-plant (2)
                            let projectRow = 
                            '<div class="move " ondblclick="showProject(' + projects[i].id + ')" id="move"><div><img class="img" href= "station.png" src="/station.png" alt="alt" srcset="/station.png"></div><br> <br><br><div  >' + projects[i].name + add + dropdown+'</div></div>' ;
                            var x = projects[i].top ;
                            var y =  projects[i].left ;
                            $("#projects-table-body") .append(projectRow , $(projectRow) .attr("id", "id_" + i) .attr("class",'new-move').offset({top:x , left:y}) );  
                            $('.move').hide();
                        }
                        else  if   (m==4) { // اذا كان النوع محول   
                            let transname = projects[i].transefer_id ;
                            for (var i2 = 0; i2 < transformer.length; i2++) 
                    {
                        if (transname == transformer[i2].id ) {
                            console.log(transname);
                            let urltranseformers = $('meta[name=app-url]').attr("content") + "/admin/transeformers/fetchTranse/" + transname +"";

                            let projectRow = 
                            '<div class="move " ondblclick="fetchTranc(' + projects[i].id + ')" id="move">\
                                <div>\
                                    <img class="img" href= "power-plant.png" src="/power-plant.png" alt="alt" srcset="/power-plant.png"> <br>\
                                </div>\
                                <br> <br> <div  >' + ' <a  href="'+ urltranseformers +'">' + transformer[i2].t_no  +' </a>'+ add + dropdown+'\
                                    </div>\
                            </div>' ;
                            var x = projects[i].top ;
                            var y =  projects[i].left ;
                            
                            $("#projects-table-body") .append(projectRow , $(projectRow) .attr("id", "id_" + i) .attr("class",'new-move').offset({top:x , left:y}) );  
                            $('.move').hide();

                        }
                    }

                        }
                        else  if   (m== 5) { // اذا كان النوع سكين    
                            let ctname = projects[i].ct_id ;
                            console.log(ctname);

                            for (var i2 = 0; i2 < cts.length; i2++) 
                    {
                        if (ctname == cts[i2].id ) {
                            let urlct = $('meta[name=app-url]').attr("content") + "/admin/cts/fetchCt/" + ctname +"";
                            if (projects[i].ct_postion ==0) {
                                let projectRow = 
                            '<div class="move " ondblclick="cttozero(' + projects[i].id + ')" id="move">\
                                <div>\
                                    <img class="img" href= "switch.png" src="/switch.png" alt="alt" srcset="/switch.png"> <br>\
                                </div>\
                                <br> <br> <div  >'+ cts[i2].ct_no + add + dropdown+'\
                                    </div>\
                            </div>' ;
                            var x = projects[i].top ;
                            var y =  projects[i].left ;
                            
                            $("#projects-table-body") .append(projectRow , $(projectRow) .attr("id", "id_" + i) .attr("class",'ct-0').offset({top:x , left:y}) );  
                            $('.move').hide();

                            }
                            if (projects[i].ct_postion ==1) {
                                let projectRow = 
                            '<div class="move " ondblclick="cttoone(' + projects[i].id + ')" id="move">\
                                <div>\
                                    <img class="img" href= "switch-on.png" src="/switch-on.png" alt="alt" srcset="/switch-on.png"> <br>\
                                </div>\
                                <br> <br> <div  >'+ cts[i2].ct_no + add + dropdown+'\
                                    </div>\
                            </div>' ;
                            var x = projects[i].top ;
                            var y =  projects[i].left ;
                            
                            $("#projects-table-body") .append(projectRow , $(projectRow) .attr("id", "id_" + i) .attr("class",'ct').offset({top:x , left:y}) );  
                            $('.move').hide();

                            }
                            }
                        }
                        }


                            else {  // اذا كان النوع سكيين  
                            let projectRow = 
                            '<div class="move " ondblclick="showProject(' + projects[i].id + ')" id="move"><hr><div  >' + projects[i].ct_id + add + dropdown+'</div></div>' 
                            // '<td>' + projects[i].top + '</td>' +
                            // '<td>' + projects[i].left + '</td>' +
                            // '<td>' + projects[i].station + '</td>' +
                            // '<td>' + projects[i].descreption + '</td>' +
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

        // اظهار اضافة رقم المعده في حالة اختيارها من المودل 
        $('#station').on('change', function () {
            $("#station-select").hide("");
            $("#transe-select").hide("");
            $("#ct-select").hide("");
            $("#feeder-select").hide("");
            $(".feeder_main").show("");
            $(".transe-how-dropdown").val("");

            // $(".show-dropdown").html(""); 
            // $(".transe-how-dropdown").html("");

            let value =  $('#station').val();
             if (value == 1)  // اذا كان الاختيار محطه 
              {    
                let url = $('meta[name=app-url]').attr("content") + "/projects";
                $('#station-select').show();
                $(".show-dropdown").val("");
                $(".show-dropdown").html("");
                $(".feeder_main").show("");

                    $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#show-dropdown").html('<option  value="">-- Select station --</option>');
                        let stations = response.stations;
                        console.log(stations );
                        $.each(response.stations, function (key, value) {
                            $(".show-dropdown").append('<option value="' + value
                                .station_no + '">' + value.station_no + '</option>');
                        });
                        },
                            error: function(response) {
                                console.log(response.responseJSON)
                            }
                });
             
           
            } 
            else if (value == 2 )   //  اذا كان الاختيار اضافة فيدر للاسفل   
                {    
                let url = $('meta[name=app-url]').attr("content") + "/projects";
                $('#feeder-select').show();
                $(".feeder-show-dropdown").val("");
                $(".feeder-show-dropdown").html("");
                $(".feeder_main").hide();

                    $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $(".feeder-show-dropdown").html('<option value="">-- Select feeder --</option>');
                        let feeder = response.feeder;
                        console.log(feeder );
                        $.each(response.feeder, function (key, value) {
                            $(".feeder-show-dropdown").append('<option value="' + value
                                .id + '">' + value.line_no + '</option>');
                        });
                        },
                            error: function(response) {
                                console.log(response.responseJSON)
                            }
                });

                console.log('else if ');
            }
            else if (value == 3 )   //  اذا كان الاختيار اضافة فيدر لليمين   
                {    
                let url = $('meta[name=app-url]').attr("content") + "/projects";
                $('#feeder-select').show();
                $(".feeder-show-dropdown").val("");
                $(".feeder-show-dropdown").html("");
                $(".feeder_main").hide();
                    $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $(".feeder-show-dropdown").html('<option value="">-- Select feeder --</option>');
                        let feeder = response.feeder;
                        console.log(feeder );
                        $.each(response.feeder, function (key, value) {
                            $(".feeder-show-dropdown").append('<option value="' + value
                                .id + '">' + value.line_no + '</option>');
                        });
                                             
                        },
                            error: function(response) {
                                console.log(response.responseJSON)
                            }
                });

                console.log('else if ');
            }

            else if (value == 4)   // اذا كان الاختيار اضافة محول 
                {    
                let url = $('meta[name=app-url]').attr("content") + "/projects";
                $('#transe-select').show();
                $(".transe-how-dropdown").val("");
                $(".transe-how-dropdown").html("");
                $(".feeder_main").show("");

                    $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#transe-how-dropdown").html('<option value="">-- Select transformer --</option>');
                        let transformer = response.transformer;
                        console.log(transformer );
                        $.each(response.transformer, function (key, value) {
                            $(".transe-how-dropdown").append('<option value="' + value
                                .id + '">' + value.t_no + '</option>');
                        });
                        },
                            error: function(response) {
                                console.log(response.responseJSON)
                            }
                });

                console.log('else if ');
            }
            else if (value == 5) { //   ct اذا كان الاختيار اضافة  
                let url = $('meta[name=app-url]').attr("content") + "/projects";
                $('#ct-select').show();
                $(".ct-show-dropdown").val("");
                $(".ct-show-dropdown").html("");
                $(".feeder_main").show("");

                    $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#ct-show-dropdown").html('<option value="">-- Select C-T --</option>');
                        let cts = response.cts;
                        console.log(cts );
                        $.each(response.cts, function (key, value) {
                            $(".ct-show-dropdown").append('<option value="' + value
                                .id + '">' + value.ct_no + '</option>');
                        });
                        },
                            error: function(response) {
                                console.log(response.responseJSON)
                            }
                });

                console.log('else if 5 ');
            }

             else {
                $(".feeder_main").show("");
                $('#station-select').hide();
                $("#station-select").val("");

                console.log('else  ');

            }});

            /*
            show modal for creating a record and 
            empty the values of form and remove existing alerts
        */
        // اغلاق وفتح السكين 
        function cttozero(x )
            {
                let newValue = x ;
                $("#save-project-btn").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/projects/ct_postion/" + newValue;
            let data = {
                id: newValue,
                ct_postion: '1' ,
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "post",
                data: data,
                success: function(response) {
                    $("#save-project-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert"><b>Project Updated Successfully</b></div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#top").val("");
                    $("#left").val("");
                    $("#station").val("");
                    $("#feeder_id").val("");
                    $("#ct_id").val("");
                    $("#descreption").val("");
                    $("#ct_postion").val("");

                    $("#avr_id").val("");
                    $("#sectionlazy_id").val("");
                    $("#autorecloser_id").val("");
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
        let descreptionValidation = "";
        if (typeof errors.descreption !== 'undefined') 
                        {
                            descreptionValidation = '<li>' + errors.descreption[0] + '</li>';
                        }
                        let nameValidation = "";
        if (typeof errors.name !== 'undefined') 
                        {
                            nameValidation = '<li>' + errors.name[0] + '</li>';
                        }
         
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + nameValidation + descreptionValidation + '</ul>' +
        '</div>';
        $("#error-div").html(errorHtml);        
    }
                }
            });

                console.log(12 );
            }

            function cttoone(x )
            {
                let newValue = x ;
                $("#save-project-btn").prop('disabled', true);
            let url = $('meta[name=app-url]').attr("content") + "/projects/ct_postion/" + newValue;
            let data = {
                id: newValue,
                ct_postion: '0' ,
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "post",
                data: data,
                success: function(response) {
                    $("#save-project-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert"><b>Project Updated Successfully</b></div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#top").val("");
                    $("#left").val("");
                    $("#station").val("");
                    $("#feeder_id").val("");
                    $("#ct_id").val("");
                    $("#descreption").val("");
                    $("#ct_postion").val("");

                    $("#avr_id").val("");
                    $("#sectionlazy_id").val("");
                    $("#autorecloser_id").val("");
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
        let descreptionValidation = "";
        if (typeof errors.descreption !== 'undefined') 
                        {
                            descreptionValidation = '<li>' + errors.descreption[0] + '</li>';
                        }
                        let nameValidation = "";
        if (typeof errors.name !== 'undefined') 
                        {
                            nameValidation = '<li>' + errors.name[0] + '</li>';
                        }
         
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + nameValidation + descreptionValidation + '</ul>' +
        '</div>';
        $("#error-div").html(errorHtml);        
    }
                }
            });
            }
                // نهاية اغلاق وفتح السكين 
        function createProject()
        {
            $("#alert-div").html("");
            $("#error-div").html("");  
            $(".show-dropdown").html(""); 
            $("#update_id").val("");
            $("#name").val("");
            $("#top").val("");
            $("#left").val("");
            $("#station").val("");
            $("#descreption").val("");
            $("#transefer_id").val("");
            $("#feeder").val("");
            $("#second_feeder").val("");
            $("#ct").val("");
            $("#ct_postion").val("");
            $("#station-select").hide();
            $("#station-select").html("");
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
                feeder_id: $(".feeder-show-dropdown").val(),
                feeder_id_two: $("#feeder_id").val(),
                descreption: $("#descreption").val(),
                transefer_id: $("#transefer_id").val(),
                feeder: $("#feeder_id").val(),
                second_feeder: $("#second_feeder").val(),
                ct_id: $("#ct_id").val(),
                ct_postion:$("#ct_postion").val(),
                avr_id: $("#avr_id").val(),
                sectionlazy_id: $("#sectionlazy_id").val(),
                autorecloser_id: $("#autorecloser_id").val(),
                
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
                    let successHtml = '<div class="alert alert-success" role="alert"><b> Created Successfully</b></div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#top").val("");
                    $("#left").val("");
                    $("#station").val("");
                    $("#feeder_id").val("");
                    $("#feeder-show-dropdown").val("");
                    $("#ct_id").val("");
                    $("#descreption").val("");
                    $("#ct_postion").val("");
                    $("#avr_id").val("");
                    $("#sectionlazy_id").val("");
                    $("#autorecloser_id").val("");

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
        let descreptionValidation = "";
        if (typeof errors.descreption !== 'undefined') 
                        {
                            descreptionValidation = '<li>' + errors.descreption[0] + '</li>';
                        }
                        let nameValidation = "";
        if (typeof errors.name !== 'undefined') 
                        {
                            nameValidation = '<li>' + errors.name[0] + '</li>';
                        }
         
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + nameValidation + descreptionValidation + '</ul>' +
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
                    $("#descreption").val(project.descreption);
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
                        let newx =parseInt(x) +220;
                        $("#top").val(newx);

                        $("#left").val(newY);
                        console.log('1');
                    }
                  else  if (project.station==3) {
                        let y = project.left ;
                        let newY =parseInt(y) +100;
                        $("#left").val(newY);
                        $("#top").val(project.top);
                        console.log('22222222222222');

                    }

                    else {
                        let y = project.left ;
                        let newY2 =parseInt(y) +100;
                        $("#left").val(newY2);
                        $("#top").val(project.top);

                        console.log('333333333333');


                    }
                    $("#feeder_id").val(project.feeder_id);
                    $("#descreption").val(project.descreption);
                    $("#transefer_id").val(project.transefer_id);
                    $("#second_feeder").val(project.second_feeder);
                    $("#ct").val(project.ct);
                    $("#ct_postion").val(project.ct_postion);
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
                        console.log('4');

                    }
                  else  if (project.station==3) {
                        let y = project.top ;
                        let newY =parseInt(y) +0;
                        $("#top").val(newY);
                        let x = project.left ;
                        let newY3 =parseInt(x) +150;
                        $("#left").val(newY3);

                        console.log('5');

                    }

                    else {
                        let y = project.top ;
                        let newY2 =parseInt(y) +50;
                        $("#top").val(newY2);
                        console.log('6');


                    }
                    $("#feeder_id").val(project.feeder_id);
                    $("#descreption").val(project.descreption);
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
                top: $("#top").val(),
                left: $("#left").val(),
                station: $("#station").val(),
                feeder_id: $("#feeder_id").val(),
                descreption: $("#descreption").val(),
                transefer_id: $("#transefer_id").val(),
                feeder: $("#feeder").val(),
                second_feeder: $("#second_feeder").val(),
                ct_id: $("#ct_id").val(),
                ct_postion:$("input:radio:checked").val(),
                avr_id: $("#avr_id").val(),
                sectionlazy_id: $("#sectionlazy_id").val(),
                autorecloser_id: $("#autorecloser_id").val(),
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
                    $("#top").val("");
                    $("#left").val("");
                    $("#station").val("");
                    $("#feeder_id").val("");
                    $("#ct_id").val("");
                    $("#descreption").val("");
                    $("#ct_postion").val("");

                    $("#avr_id").val("");
                    $("#sectionlazy_id").val("");
                    $("#autorecloser_id").val("");
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
        let descreptionValidation = "";
        if (typeof errors.descreption !== 'undefined') 
                        {
                            descreptionValidation = '<li>' + errors.descreption[0] + '</li>';
                        }
                        let nameValidation = "";
        if (typeof errors.name !== 'undefined') 
                        {
                            nameValidation = '<li>' + errors.name[0] + '</li>';
                        }
         
        let errorHtml = '<div class="alert alert-danger" role="alert">' +
            '<b>Validation Error!</b>' +
            '<ul>' + nameValidation + descreptionValidation + '</ul>' +
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
            $("#descreption-info").html("");
            let url = $('meta[name=app-url]').attr("content") + "/projects/" + id +"";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let project = response.project;
                    $("#name-info").html(project.name);
                    $("#descreption-info").html(project.descreption);
                    $("#view-modal").modal('show'); 
                    let stuts = project.station ;
                    if (stuts == 4) {
                        console.log(stuts); 
                        transShow(stuts);
                    } 
                   ;
     
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }
        function transShow(stuts)
        {
            console.log(stuts);
        }

        function fetchTranc(id)
        {
            $("#name-info").html("");
            $("#descreption-info").html("");
            let url = $('meta[name=app-url]').attr("content") + "/projects/fetchTranc/" + id +"";
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    console.log(response);
                    let project = response.project;
                    let cbs = response.cbs ;
                    let boxies = response.boxies ;
                    console.log(project.length);
                    console.log(cbs.length);
                    console.log(boxies.length);
                    let projectRow = 
                    '<div class="move "  id="move"> number of cb in this transformer <div  >' + cbs.length +'</div></div>' ;
                    $("#name-info") .append(projectRow );  
                    $("#view-modal").modal('show'); 
                    let boxraw = 
                    '<div class="move "  id="move"> number of box in this transformer <div  >' + boxies.length +'</div></div>' ;
                    $("#name-info") .append(boxraw );  
                    $("#view-modal").modal('show'); 

                    // for (i = 0; i < cbs.length; i++) {

                    //     let projectRow = 

                    //         '<div class="move "  id="move"><hr><div  >' + cbs[i].transe_id +'</div></div>' ;
                    //         $("#name-info") .append(projectRow );  
                    //         // $('.move').hide();
                    // //     $("#name-info").html(cbs[i].transe_id);
                    // // $("#descreption-info").html(cbs[i].trans_cb_fider_number);

                    //     // console.log(cbs[i].transe_id);

                    // }
     
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
                descreption: $("#descreption").val(),
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
        
              @endcan


</body>
</html>