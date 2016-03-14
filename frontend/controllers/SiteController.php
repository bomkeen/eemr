<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Log;



class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;
     public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','update','delete'], //เฉพาะ action create,update
                'rules' => [
                    [
                        'allow' => true, //ยอมให้เข้าถึง
                        'roles' => ['@']//คนที่เข้าสู่ระบบ 
                    ]
                ]
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    ////////////////////////////////////////////
    public function actionIndex()
    {
 
       if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $scid = $request->post('scid');
//            if (filter_var($scid, FILTER_VALIDATE_INT) != TRUE) {
//   return $this->render('index',[
//                    'int'=>'Y',
//                ]);
//}
            
            if (strlen($scid)<12){
                return $this->render('index',[
                    'len'=>'Y',
                ]);
                
            }
                  $sql = "SELECT 
            CONCAT(p.pname,' ',p.fname,' ',p.lname) as pname
,h.hospcode as hcode
,h.name hname
,vn.vstdate as vstdate
,vn.pdx as pdx
,vn.vn as vn
,icd.tname as pdx_name
,vn.item_money as price
,p.cid as cid
FROM patient p
JOIN vn_stat as vn on p.hn=vn.hn 
JOIN hospcode h ON h.hospcode=10769
LEFT OUTER JOIN icd101 as icd on vn.pdx=icd.code
WHERE p.cid=$scid ORDER BY vn.vstdate DESC limit 3";
//////////////Log//////////////
$log=new Log();
$log->username=Yii::$app->user->identity->username;
$log->scid=$scid;
$log->sdate=date("Y-m-d H:i:s");
$log->save();
//////////////////////log////////////////////
            $rawData = \Yii::$app->hosxp->createCommand($sql)->queryAll();
           
              $dataProvider = new \yii\data\ArrayDataProvider([
            'key' => 'vn',//
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
 
        return $this->render('index', [
               'dataProvider' => $dataProvider,
            'scid'=>$scid,
           
           
        ]);
    }
    
     return $this->render('index', [
               //'dataProvider' => $dataProvider,
           
        ]);
    }
    ///////////////////////////////////////
    public function actionDetail($vn,$hcode) {
        
         $opdscreen = Yii::$app->hosxp->createCommand("SELECT 
CONCAT(p.pname,' ',p.fname,' ',p.lname) as pname
,o.bpd as bpd
,o.bps as bps
,o.cc as cc
,o.temperature as tem
,o.bw as bw
FROM opdscreen o JOIN patient p on o.hn=p.hn where vn=$vn ");
        $q1 = $opdscreen->queryAll();
        
        $drug=  Yii::$app->hosxp->createCommand("SELECT 
d.name as dname
,op.qty as qty
,op.sum_price as sum
from opitemrece op 
LEFT JOIN drugitems d on op.icode=d.icode
where vn=$vn and op.icode like '1%'");
        $q2 = $drug->queryAll();
         $diag=Yii::$app->hosxp->createCommand("SELECT 
ov.icd10 as dcode
,c.name as dname
,d.name as dtype 
FROM ovstdiag ov 
JOIN icd101 as c ON ov.icd10=c.code
JOIN diagtype d on ov.diagtype=d.diagtype
WHERE vn=$vn");
        $q3 = $diag->queryAll();
        
        return $this->render('detail',[
            'q1'=>$q1,
            'q2'=>$q2,
            'q3'=>$q3,
        ]);
    }
   
    
    public function actionDetail2($vn,$hcode) {
     
         $opdscreen = Yii::$app->hosxp->createCommand("SELECT 
CONCAT(p.pname,' ',p.fname,' ',p.lname) as pname
,o.bpd as bpd
,o.bps as bps
,o.cc as cc
,o.temperature as tem
,o.bw as bw
FROM opdscreen o JOIN patient p on o.hn=p.hn where vn=$vn ");
        $q1 = $opdscreen->queryAll();
      
        $drug=  Yii::$app->hosxp->createCommand("SELECT 
d.name as dname
,op.qty as qty
,op.sum_price as sum
from opitemrece op 
LEFT JOIN drugitems d on op.icode=d.icode
where vn=$vn and op.icode like '1%'");
        $q2 = $drug->queryAll();
        
         $diag=Yii::$app->hosxp->createCommand("SELECT 
ov.icd10 as dcode
,c.name as dname
,d.name as dtype 
FROM ovstdiag ov 
JOIN icd101 as c ON ov.icd10=c.code
JOIN diagtype d on ov.diagtype=d.diagtype
WHERE vn=$vn");
        $q3 = $diag->queryAll();
        
        return $this->renderAjax('detail2', [ 
            'q1'=>$q1,
            'q2'=>$q2,
            'q3'=>$q3,
        ]);
    }
    public function actionAbout() {
        return $this->render('about');
        
    }
    
}
