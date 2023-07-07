<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDiagramRequest;
use App\Http\Requests\StoreDiagramRequest;
use App\Http\Requests\UpdateDiagramRequest;
use App\Models\Ct;
use App\Models\Diagram;
use App\Models\Station;
use App\Models\Transeformer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Project;
use App\Models\Cb;
use App\Models\Line;
use App\Models\box;
use App\Models\Rmu;
use App\Models\Avr;
use App\Models\SectionLazy;
use App\Models\Autorecloser;


 
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *        'name_id',

     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('diagram_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $projects = Project::all();
        $stations = Station::all();
        $cts = Ct::all();
        $avrs = avr::all();
        $sectionlazys = sectionlazy::all();
        $autoreclosers = autorecloser::all();
        $rmus = Rmu::get();
        $feeder = Line::get();

        // $transe_id = $projects ->transefer_id;
        $transformer = Transeformer:: all();
        // $t_no = $transformer->t_no;
     
        return  response()->json([
            'transformer' => $transformer ,
            'cts' => $cts ,
            'projects' => $projects, 
            'stations' => $stations,
            'avrs' => $avrs ,
            'sectionlazys' => $sectionlazys,
            'autoreclosers' => $autoreclosers,
            'feeder' => $feeder,
            'rmus' => $rmus] ) ;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'nullable',
            'descreption' => 'nullable',
            'station' => 'nullable',
            'top' => 'required',
            'left' => 'required',
            'transefer_id' => 'nullable ',
            'feeder_id' => 'nullable',
            'second_feeder' => 'nullable',
            'ct_postion' => 'nullable',
            'ct_id' => 'nullable',

            'name_id' => 'nullable',
            'rmu_id' => 'nullable',
            'autorecloser_id' => 'nullable',
            'sectionlazy_id' => 'nullable ',
            'avr_id' => 'nullable',
        ]);
        $project = new Project();
        // $project->name = $request->name;
        $project->top = $request->top;
        $project->left = $request->left;
        $project->station = $request->station;
        $station = $project->station;
        if ($station ==2||3) {
            $project->feeder_id = $request->feeder_id_two;
            $project->ct_id = null ;
        } else  if ($station ==5) { 
            $project->ct_id = $request->ct_id;
            $project->feeder_id = $request->feeder_id;
        } else { 
            $project->ct_id = null ;
            $project->feeder_id = $request->feeder_id;
       
        };
        
        $project->descreption = $request->descreption;
        $project->transefer_id = $request->transefer_id;
        // $project->feeder = $request->feeder;
        $project->second_feeder = $request->second_feeder;
        $project->ct_postion = $request->ct_postion;

        $project->name_id = $request->name_id;
        $project->rmu_id = $request->rmu_id;

        $project->autorecloser_id = $request->autorecloser_id;
        $project->sectionlazy_id = $request->sectionlazy_id;
        $project->avr_id = $request->avr_id;

        $project->save();
        return response()->json(['status' => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        return response()->json(['project' => $project]);
    }
    public function fetchTranc($id)
    {
        $project = Project::find($id);
        $transefer_id  = $project -> transefer_id ; 
        // $transformer = Transeformer::find($transefer_id);
        // $transe_id = $transformer -> cb_no_id  ;
        // dd($transformer);
        $cbs = cb:: where("transe_id", $transefer_id )
        ->get();
        $boxies = box:: where("trans_box_id", $transefer_id )
        ->get();

        // $cbs = cb::where("transe_id ", $transe_id)
        // ->get(["trans_cb_fider_number", "id"]);

        return response()->json(['project' => $project, 'boxies' => $boxies , 'cbs' => $cbs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'nullable',
        ]);
  
        $project = Project::find($id);
        $project->top = $request->top;
        $project->left = $request->left;
        $project->station = $request->station;
        $project->descreption = $request->descreption;
        $project->transefer_id = $request->transefer_id;
        $project->feeder_id = $request->feeder_id;
        $project->second_feeder = $request->second_feeder;
        $project->ct_postion = $request->ct_postion;
        $project->ct_id = $request->ct_id;

        $project->name_id = $request->name_id;
        $project->feeder_id = $request->feeder_id;
        $project->rmu_id = $request->rmu_id;

        $project->autorecloser_id = $request->autorecloser_id;
        $project->sectionlazy_id = $request->sectionlazy_id;
        $project->avr_id = $request->avr_id;
        $project->save();
        return response()->json(['status' => "success"]);
    }
    
    public function ct_postion(Request $request, $id)
    {
        $project = Project::find($id);
        $newCtPotion =  $request->ct_postion;
        $project->ct_postion = $request->ct_postion;
        // dd($project);

        $project->save();
        return response()->json(['status' => "success"]);

      
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::destroy($id);
        return response()->json(['status' => "success"]);
    }
}