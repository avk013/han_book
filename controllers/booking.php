<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Booking extends CI_Controller {

	public function index()
	{
	//$this->load->view(view_terms);
	//print_r ($_POST);
	$date_in=$_POST["date-in"];
	$date_out=$_POST["date-out"];
	$quest=$_POST["quest"];
	$email=$_POST["email"];
	$phone=$_POST["phone"];
	$city=$_POST["city"];
	$i=explode(".",$date_in);
	$o=explode(".",$date_out);
	$aid=381074;
	//$city=-1762397;
	$cities=array(0,0,-1785903,-1785903,-1771148,-1762397,-1810561,-1829149,-1871728,-1746443,-1785434);
	$city=$cities[$city];
	$request="www.booking.com/searchresults.ru.html?aid=$aid&city=$city&nflt=ht_id%3D201&checkin_monthday=$i[0]&checkin_month=$i[1]&checkin_year=$i[2]&checkout_monthday=$o[0]&checkout_month=$o[1]&checkout_year=$o[2]&hpos=$quest";
	//echo $request;
	header("Location: http://$request");
	//aid=&city=-1762397&nflt=ht_id%3D201&checkin_monthday=8&checkin_month=3&checkin_year=2017&checkout_monthday=9&checkout_month=3&checkout_year=2017
	
	}
	public function get()
	{
	$this->load->view(booking/view.main);
	}
	
	public function view($page = 'home')
	{
	echo "+";
	}
	
}