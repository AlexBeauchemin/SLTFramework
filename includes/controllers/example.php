<?php
class ExampleController extends Controller {
    public $example_model;

    function init()
    {
        $this->example_model = new ExampleModel($this->app);
        $keys = array(
            'email',
            'name'
        );
        $data = array(
            'myemail@test.ca',
            'Alex'
        );

        $this->example_model->setData($keys,$data);
//        $this->example_model->validate();
//        $this->example_model->save();
    }

}