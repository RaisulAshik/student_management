<?php

namespace App\Imports;

use DB;
use App\Exam;
use App\ExamEnroll;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ExamEnrollsImport implements ToModel,WithStartRow,ShouldQueue,WithChunkReading,
    WithBatchInserts
{
    public $exam_id;

    public function __construct($exam_id)
    {
        $this->exam_id = $exam_id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $student = DB::table('users')->where('registration_id',$row[0])->first();
        $exam=Exam::find($this->exam_id);
       
        // POST Method example

        if ($student) {
            // $url = "http://66.45.237.70/api.php";
            // $number=$student->phone;
            // $text=$student->first_name.' '.$student->last_name.' Registration Number '.$student->registration_id.' Exam Name: '.$exam->name.' Total Marks: '.$exam->total_marks.' Your Marks:'.$row[3].' Highest Marks: '.$exam->height_marks.' Merit Position: '.$row[5].' Satisfactory Mark: '.$row[6].' - Shadow Aide And Life Line';
            // $username="01918184015";
            // $password="shadowaide01";
            // $data= array(
            // 'username'=>$username,
            // 'password'=>$password,
            // 'number'=>"$number",
            // 'message'=>"$text"
            // );

            // $ch = curl_init(); // Initialize cURL
            // curl_setopt($ch, CURLOPT_URL,$url);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // $smsresult = curl_exec($ch);
            // $p = explode("|",$smsresult);
            // $sendstatus = $p[0];
            
                $url = "http://bulksmsbd.net/api/smsapi";
                $api_key = "kmEVjYNvP8sFrDhQbWW8";
                $senderid = "8809617614336";
                $number = $student->phone;
                
                $message = $student->first_name.' '.$student->last_name.' Registration Number '.$student->registration_id.' Exam Name: '.$exam->name.' Total Marks: '.$exam->total_marks.' Your Marks:'.$row[3].' Highest Marks: '.$exam->height_marks.' Merit Position: '.$row[5].' Satisfactory Mark: '.$row[6].' - Shadow Aide And Life Line';
             
                $data = [
                    "api_key" => $api_key,
                    "senderid" => $senderid,
                    "number" => $number,
                    "message" => $message
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);
                // return $response;

        }

        if($student){
            return new ExamEnroll([
              
               'student_id'      =>$student->id,
               'exam_id'         =>$this->exam_id,
               'total_marks'     => $row[2],
               'obtained_marks'  => $row[3],
               'height_marks'    => $row[4],
               'merit_position'  => $row[5],
               'satisfactory_mark'  => $row[6],  
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
