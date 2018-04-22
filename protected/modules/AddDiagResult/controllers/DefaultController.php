<?php

class DefaultController extends Controller
{
    public function actionIndex()
    {
            $this->render('index');
    }
    
    public function actionTempStep()
    {
        $this->render('tempstep2');
    }
}