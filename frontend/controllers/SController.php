<?php

namespace frontend\controllers;
use common\models\TmpS;
use yii;


class SController extends \yii\web\Controller
{
    public function actionIndex()
    {
 $model= new TmpS();
       
 if ($model->load(Yii::$app->request->post())) {
    $scid=$model->cid;
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
//$log=new Log();
//$log->username=Yii::$app->user->identity->username;
//$log->scid=$scid;
//$log->sdate=date("Y-m-d H:i:s");
//$log->save();
//////////////////////log////////////////////
            $rawData = \Yii::$app->hosxp->createCommand($sql)->queryAll();
                  $dataProvider = new \yii\data\ArrayDataProvider([
            'key' => 'vn',//
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
                  return $this->render('index', [
               'dataProvider' => $dataProvider,
            'model'=>$model,
           
           
        ]);
        
 }
 
        return $this->render('index', [
              'model'=>$model,
                 
           
        ]);
    }

}

