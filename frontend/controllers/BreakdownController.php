<?php

namespace frontend\controllers;

use Yii;
use app\models\Breakdown;
use app\models\BreakdownColor;
use app\models\BreakdownDetail;
use app\models\BreakdownScale;
use app\models\search\Breakdown as BreakdownSearch;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use app\modules\master\models\Customer;

/**
 * BreakdownController implements the CRUD actions for Breakdown model.
 */
class BreakdownController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Breakdown models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BreakdownSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Breakdown model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Breakdown model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Breakdown();
        
        $customers = ArrayHelper::map(Customer::find()->orderBy('name')->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'customers' => $customers,
            ]);
        }
    }
    
    public function actionCreateColor($id)
    {
        $model = new BreakdownColor();
        $breakdown = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $inputFile = $model->getUploadedfilePath('excel_file');
            try {
              $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
              $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
              $objPHPExcel = $objReader->load($inputFile);
            } catch (Exception $e) {
              die('Error');
            }
            
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            
            // breakdown details
            for ($row=1; $row < $highestRow+1; $row++) { 
              $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row, NULL, TRUE, FALSE);
              
              if ($row == 1) {
                continue;
              }

              $detail = New BreakdownDetail();
              $detail->breakdown_id = $model->breakdown_id;
              $detail->breakdown_color_id = $model->id;
              $detail->hangtag = $rowData[0][0];
              $detail->unit_quantity = $rowData[0][1];
              $detail->code = $rowData[0][2];
              $detail->quantity = $rowData[0][3];
              $detail->allowance = $rowData[0][4];
              if ($detail->hangtag == '' && $detail->unit_quantity == '') {
                continue;
              }
              $detail->save();
              
            }
            
            // breakdown detail scales
            
            $sheet = $objPHPExcel->getSheet(1);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            
            for ($row=1; $row < $highestRow+1; $row++) { 
              $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row, NULL, TRUE, FALSE);
              $colData = range('A', $highestColumn);
              if ($row == 1) {
                  $code = [];
                  foreach ($colData as $idx => $col) {
                    array_push($code, $rowData[0][$idx]);
                  }
              }
              
              if ($row > 1) {
                  foreach ($colData as $idx => $col) {
                    $scale = New BreakdownScale;
                    $scale->breakdown_id = $model->breakdown_id;
                    $scale->breakdown_color_id = $model->id;
                    $scale->size = $rowData[0][0];
                    $scale->code = $code[$idx];
                    $scale->scale = $rowData[0][$idx];
                    if ($scale->code != null) {
                      $scale->save();
                    }
                  }
              }
            }
            
            
            return $this->redirect(['view', 'id' => $breakdown->id]);
        }

        return $this->render('/breakdown_color/create', [
            'model' => $model,
            'breakdown' => $breakdown,
        ]);
    }

    /**
     * Updates an existing Breakdown model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $customers = ArrayHelper::map(Customer::find()->orderBy('name')->all(), 'id', 'name');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'customers' => $customers,
            ]);
        }
    }
    
    public function actionExportBreakdown($id)
    {
      $breakdown = $this->findModel($id);
      $colors = $breakdown->getColors();
      
      $objPHPExcel = new \PHPExcel();
 
      $sheet=0;
        
      $objPHPExcel->setActiveSheetIndex($sheet);

      foreach(range('A','Z') as $columnID) {
          $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
              ->setAutoSize(13);
      }
      
      $activeSheet = $objPHPExcel->getActiveSheet();
      
      $activeSheet->getStyle("A:Z")->getFont()
        ->setSize(8)
        ->setBold(true);
        
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:E2');
      
      $activeSheet
          ->getStyle('A2:E2')
          ->getAlignment()
          ->setHorizontal("center");
      
      $activeSheet->setCellValue('A2', "BREAKDOWN");
        
      $headers = [
        ['title' => 'STYLE', 'value' => $breakdown->style],
        ['title' => 'BODY', 'value' => $breakdown->body],
        ['title' => 'DRAWSING', 'value' => $breakdown->drawsing],
        ['title' => 'DESCRIPTION', 'value' => $breakdown->description],
        ['title' => 'RCVD PA', 'value' => $breakdown->receive_date_1.' / '.$breakdown->receive_date_2],
        ['title' => 'PO#', 'value' => $breakdown->purchase_order_number],
        ['title' => 'DELIVERY', 'value' => $breakdown->delivery_date],
      ];
      
      $row = 4;

      foreach ($headers as $head) {  
          $activeSheet->setCellValue('A'.$row,$head['title']); 
          $activeSheet->setCellValue('B'.$row,$head['value']);
          $row++ ;
      }
      
      $row++;
      
      $activeSheet
        ->setCellValue('A'.$row, "PPK")
        ->setCellValue('B'.$row, "COLOR");
      
      // header
      $header_scales = BreakdownScale::find()->select(['size'])
                                             ->where(['breakdown_id' => $id])
                                             ->groupBy(['id','size'])
                                             ->orderBy('id')
                                             ->all();
      $check_header_scale = [];
      $header_column = 2;
      $grand_per_size = [];
      foreach ($header_scales as $i => $header_scale) {
        if (in_array($header_scale->size, $check_header_scale)) {
          continue;
        }
        $check_header_scale[] = $header_scale->size;
        $activeSheet->setCellValueByColumnAndRow($header_column, $row, $header_scale->size);
        $header_column++;
      }

      $activeSheet->setCellValueByColumnAndRow($header_column, $row, "TOTAL");
      $header_column++;
      $activeSheet->setCellValueByColumnAndRow($header_column, $row, "HANGTAG");
      
      $row++;
      $getRow = $row; //get initial row value first table
      
      // Column 1 Code
      $codes = BreakdownDetail::find()->where(['breakdown_id' => $id])
                                      ->orderBy('breakdown_color_id, hangtag, code','ASC')
                                      ->all();
                                     
      $code_row = $getRow;
      $check_hantags = null;
      $len_codes = count($codes);
      
      foreach ($codes as $code_index => $code) {
        if ($check_hantags != null && $check_hantags != $code->hangtag) {
          $code_row++;
          $resetGetRow = $getRow;
          $activeSheet->setCellValue('A'.$code_row, "TOTAL");
          for ($totalColumn=2; $totalColumn < $header_column; $totalColumn++) { 
              $sum_total_size_hangtags = 0;
              for ($total_row=$getRow; $total_row < $code_row; $total_row++) { 
                $getCellvalue = $activeSheet->getCellByColumnAndRow($totalColumn,$total_row)->getValue();
                $sum_total_size_hangtags += $getCellvalue;
              }
              $grand_per_size[$totalColumn][] = $sum_total_size_hangtags;
              $activeSheet->setCellValueByColumnAndRow($totalColumn, $code_row, $sum_total_size_hangtags);  
          }
          $code_row++;
          $code_row++;
          $getRow = $code_row;
        }
        $code_scales = BreakdownScale::find()->select(['id','scale'])
                                             ->where(['breakdown_id' => $id])
                                             ->andWhere(['code' => $code->code])
                                             ->orderBy('id', 'ASC')
                                             ->all();
        $afterCode = '';
        
        foreach ($code_scales as $idx => $code_scale) {
          $afterCode .= strval($code_scale->scale);
        }
        
        $activeSheet->setCellValueByColumnAndRow(0, $code_row, $code->code.$afterCode);
        $activeSheet->setCellValueByColumnAndRow(1, $code_row, $code->breakdownColor->color_name);
        
        $size_index = 0;
        $sum_quantity_scale = 0;
        
        for ($bodyColumn=2; $bodyColumn < $header_column-1; $bodyColumn++) { 
          $bodyScales = BreakdownScale::find()
            ->select(['scale'])
            ->where(['breakdown_id' => $id])
            ->andWhere(['code' => $code->code])
            ->andWhere(['size' => $check_header_scale[$size_index]])
            ->one();
            
            $quantity_scale = $bodyScales->scale * $code->quantity;
            $sum_quantity_scale += $quantity_scale;
            $activeSheet->setCellValueByColumnAndRow($bodyColumn, $code_row, $quantity_scale);
            $size_index ++;
        }
        
        $activeSheet->setCellValueByColumnAndRow($header_column-1, $code_row, $sum_quantity_scale);
        $activeSheet->setCellValueByColumnAndRow($header_column, $code_row, $code->hangtag);
        $code_row++;
        
        if ($code_index == $len_codes - 1) {
          $code_row++;
          $activeSheet->setCellValue('A'.$code_row, "TOTAL");
          for ($totalColumn=2; $totalColumn < $header_column; $totalColumn++) { 
              $sum_total_size_hangtags = 0;
              for ($total_row=$getRow; $total_row < $code_row; $total_row++) { 
                $getCellvalue = $activeSheet->getCellByColumnAndRow($totalColumn,$total_row)->getValue();
                $sum_total_size_hangtags += $getCellvalue;
              }
              $grand_per_size[$totalColumn][] = $sum_total_size_hangtags;
              $activeSheet->setCellValueByColumnAndRow($totalColumn, $code_row, $sum_total_size_hangtags);  
          }
          $code_row++;
          $code_row++;
        }

        $check_hantags = $code->hangtag;
      }
      
      $activeSheet->setCellValue('A'.$code_row, "GRAND TOTAL");

      for ($totalColumn=2; $totalColumn < $header_column; $totalColumn++) { 
        $activeSheet->setCellValueByColumnAndRow($totalColumn, $code_row, array_sum($grand_per_size[$totalColumn]));
      }
      
      header('Content-Type: application/vnd.ms-excel');
      $filename = "breakdowns_".date("d-m-Y-His").".xlsx";
      header('Content-Disposition: attachment;filename='.$filename .' ');
      header('Cache-Control: max-age=0');
      $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save('php://output');

    }

    /**
     * Deletes an existing Breakdown model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionDeleteColor($id)
    {
        $color = $this->findColor($id);
        $breakdown = $this->findModel($color->breakdown_id);
        $color->delete();
        
        return $this->redirect(['view', 'id' => $breakdown->id]);
    }

    /**
     * Finds the Breakdown model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Breakdown the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Breakdown::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findColor($id)
    {
      if (($color = BreakdownColor::findOne($id)) !== null) {
          return $color;
      } else {
          throw new NotFoundHttpException('The requested page does not exist.');
      }
    }
}
