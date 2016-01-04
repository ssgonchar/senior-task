<?php
/**
 * Created by PhpStorm.
 * User: mrikirill
 */

Class Controller_tree extends Route{

    /**
     * Controller export
     * @return mixed
     */
    public function action_export()
    {
        return $this->model->tree->exportTree();
    }
}