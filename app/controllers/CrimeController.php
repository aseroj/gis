<?php

class CrimeController extends BaseController {
  protected $layout = "layouts.main";

  public function getIndex() {
    $crime = USCrime::all();
    $this->layout->content = View::make('crime')->with('uscrime', $crime);        
  }

}
