<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomDataController extends AbstractController
{
    
    public $sum_any_qn_count;
    public $sum_all_qn_count;

    /**
     * @Route("/customdata/groupcount/any")
     */
    public function getAnyValidQnsCount()
    {
        //Assign user input string to below variable.
        $input_data_array = "";
        if (isset($input_data_array)&& !empty($input_data_array)) {
            //Divide user input string into array groupvise.
            $input_data_array = preg_split("#\n\s*\n#Uis",$input_data_array);
       
            foreach ($input_data_array as $unq_group_name => $person_data) {
                //Find unique questions count answered by persons 
                $count =  count(array_unique(str_split(preg_replace("/\s+/", "", $person_data))));
                $this->sum_any_qn_count +=  $count;     
            }
            //Display sum in view page as response.
            return $this->render('custom_data.html.twig',["sum" => $this->sum_any_qn_count]);
        }
        
    }

    /**
     * @Route("/customdata/groupcount/all")
     */
    public function getAllValidQnsCount()
    {
        $input_data_array = "";

        if (isset($input_data_array) && !empty($input_data_array)) {
            //Divide user input string into array groupvise.
            $input_data_array = preg_split("#\n\s*\n#Uis",$input_data_array);

            foreach ($input_data_array as $unq_group_name => $person_data) {
                //Find duplicate questions count answered by persons.
                $unq_persons_list = explode("\n",$person_data);
                $unq_persons_count = count($unq_persons_list);
                //To get no of times question was answered.
                $duplicate_qns = array_count_values(str_split(preg_replace("/\s+/", "",$person_data)));
           
                foreach ($duplicate_qns as $name => $count_dup) {
                    //Check whether all persons answeres to any question.
                    $this->sum_all_qn_count = $this->sum_all_qn_count +  ($count_dup == $unq_persons_count ? 1 : 0);
                }
            }
        }
        return $this->render('custom_data.html.twig',["sum" => $this->sum_all_qn_count]);
    }
}

