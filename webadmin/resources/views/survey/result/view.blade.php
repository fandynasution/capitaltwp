@extends('template.layout2.base')
@section('content')
<div class="nk-content-body">
    <div class="components-preview wide-md mx-auto">
      <div class="nk-block nk-block-lg">
        <div class="nk-block-head">
          <div class="nk-block-head-content">
            <h4 class="nk-block-title">Survey Result 
                {{-- <div class="float-right">
                    <button type="button" hidden="true" style="padding:7px 10px" class="btn btn-primary" id="savefrmxl" onclick="generate()"><em class="icon ni ni-download"></em> &nbsp;Generate PDF</button>&nbsp;&nbsp;<button type="button" class="btn btn-secondary" style="padding:7px 10px" onclick="goback()"><em class="icon ni ni-arrow-left-circle-fill"></em>&nbsp;Back</button>
                </div> --}}
            </h4>
          </div>
        </div>
        <div class="card card-preview">
            <div class="card-inner">
                
                <?php 
                $jumlah[]='';

                $s='';$q='';$k='';$l='';$e='';$r='';
                $no=0;
                    
                if ($Responden[0]->cnt == 0) {
                    $res = 0;
                } else {
                    $res = $Responden[0]->cnt;
                }

                $JDebtor = 0;
                foreach ($dtsurvey as $key) {
                        
                    $e=$key->title;
                    $o1= '';
                    if ($e!= $r) {
                        echo '<h5 style=" margin-top: 10px;">'. $o1 = $key->title.'</h5>Total Responden : '.$res;
                    }
                    $r=$e;
                    
                    $k=$key->content;
                    $z= '';
                    if ($k!= $l) {
                        echo '<br><hr><h6>'. $z = $key->content.'</h6><hr>';
                    }
                    $l=$k;
                    $s = $key->options;

                    if($s!= $q){
    if($res!=0){
        $JDebtor = ($key->jumlah/$res)*100;
    }else{
        $JDebtor = 0;
    }

    $no++;
    echo '<table width="100%">
            <tr>
                <td width="75%">'. $key->line_no . '. '.$key->options.' <br>
                    <div class="progress progress-lg" style="margin-bottom: 10px;">
                        <div class="progress-bar progress-bar-striped" role="progressbar" 
                        aria-valuenow="'.(int)$JDebtor.'" aria-valuemin="0" aria-valuemax="100"
                        style="width:'.(int)$JDebtor.'%"></div>
                    </div>';

    // ---> Tambahkan list responden per opsi
    echo '<strong>Responden:</strong><br>';
}

if(!empty($key->email_addr)){
    echo '<small>- '.$key->company_name.' ('.$key->date_created.')</small><br>';
}

if($s != (isset($dtsurvey[$no]->options) ? $dtsurvey[$no]->options : null)){
    echo '</td>
            <td width="25%"><span class="badge badge-pill badge-info" style="margin-left:15px">'
            .(int)$JDebtor.'%</span></td>
          </tr></table>';
}
                        
                    $q = $s;

                }
                
            ?>
                
            
            </div>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
    function goback(){
        window.location.href="{{ url('survey/result') }}";
    }
    function generate(){
        var publish_id="{{ $id }}";
        // alert(publish_id);return;
        var site_url = '{{ url("/survey/result/export")}}'+'/'+publish_id;
        window.open(site_url);
            // $.post(site_url,
            //     {id:publish_id,"_token": "{{ csrf_token() }}" },
            //     function(data,status) {
            //         if(status=='success'){
            //             // window.open(data);
            //         }else{
            //             Swal.fire({
            //                         title: "Information",
            //                         icon:"error",
            //                         text: "Failed generating pdf file."
            //                     });
            //         }
            // });
    }
</script>
@endsection
