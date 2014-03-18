<?php

class Main extends CI_Controller {

    function __construct() {
        // Call the Controller constructor
        parent::__construct();
    }

    function index() {
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('movie_model');
        $this->load->model('theater_model');

        //Then we call our model's get_movies function
        $movies = $this->movie_model->get_movies();

        //If it returns some results we continue
        if ($movies->num_rows() > 0) {

            //Prepare the array that will contain the data
            $moviesArray = array();

            foreach ($movies->result() as $row) {
                $moviesArray[$row->id] = $row->title;
            }
            //Next step is to place our created array into a new array variable, one that we are sending to the view.
            $data['movies'] = $moviesArray;
        }

        //Then we call our model's get_venues function
        $venues = $this->theater_model->get_theaters();

        //If it returns some results we continue
        if ($venues->num_rows() > 0) {

            //Prepare the array that will contain the data
            $venuesArray = array();

            foreach ($venues->result() as $row) {
                $venuesArray[$row->id] = $row->name;
            }
            //Next step is to place our created array into a new array variable, one that we are sending to the view.
            $data['venues'] = $venuesArray;
        }

        $data['main'] = 'main/index';
        $this->load->view('template', $data);
    }

    function showShowtimesByDateAndMovie($dateString, $movieId) {

        //First we load the library and the model
        $this->load->library('table');
        $this->load->model('showtime_model');

        /*if ($dateString == "promptdate") {
            echo "Please select a date";
            return;
        }
        if ($movieId == "promptmovie") {
            echo "Please select a movie";
            return;
        }*/
        $date = date_create($dateString);
        //Then we call our model's get_showtimes function
        $showtimes = $this->showtime_model->get_showtimes();

        //If it returns some results we continue
        if ($showtimes->num_rows() > 0) {

            //Prepare the array that will contain the data
            $table = array();

            $table[] = array('Movie', 'Theater', 'Address', 'Date', 'Time', 'Available', 'Link');

            foreach ($showtimes->result() as $row) {
                $dateDiff = date_diff($date, date_create($row->date));
                if ($dateDiff->format("%d") == 0 && $movieId == $row->movieId) {
                    $table[] = array($row->title, $row->name, $row->address, $row->date, $row->time, $row->available, anchor('main/displaySeats/' . $row->id, $row->id));
                }
            }
            //Next step is to place our created array into a new array variable, one that we are sending to the view.
            $data['showtimes'] = $table;
        }

        //Now we are prepared to call the view, passing all the necessary variables inside the $data array
        $data['main'] = 'main/showtimes';
        $this->load->view('template', $data);
    }

    function showShowtimesByDateAndVenue($dateString, $venueId) {

        //First we load the library and the model
        $this->load->library('table');
        $this->load->model('showtime_model');

        /*if ($dateString == "promptdate") {
            echo "Please select a date";
            return;
        }
        if ($venueId == "promptvenue") {
            echo "Please select a venue";
            return;
        }*/
        $date = date_create($dateString);
        //Then we call our model's get_showtimes function
        $showtimes = $this->showtime_model->get_showtimes();

        //If it returns some results we continue
        if ($showtimes->num_rows() > 0) {

            //Prepare the array that will contain the data
            $table = array();

            $table[] = array('Movie', 'Theater', 'Address', 'Date', 'Time', 'Available', 'Link');

            foreach ($showtimes->result() as $row) {
                $dateDiff = date_diff($date, date_create($row->date));
                if ($dateDiff->format("%d") == 0 && $venueId == $row->venueId) {
                    $table[] = array($row->title, $row->name, $row->address, $row->date, $row->time, $row->available, anchor('main/displaySeats/' . $row->id, $row->id));
                }
            }
            //Next step is to place our created array into a new array variable, one that we are sending to the view.
            $data['showtimes'] = $table;
        }

        //Now we are prepared to call the view, passing all the necessary variables inside the $data array
        $data['main'] = 'main/showtimes';
        $this->load->view('template', $data);
    }

    function showShowtimes() {

        //First we load the library and the model
        $this->load->library('table');
        $this->load->model('showtime_model');

        //Then we call our model's get_showtimes function
        $showtimes = $this->showtime_model->get_showtimes();

        //If it returns some results we continue
        if ($showtimes->num_rows() > 0) {

            //Prepare the array that will contain the data
            $table = array();

            $table[] = array('Movie', 'Theater', 'Address', 'Date', 'Time', 'Available', 'Link');

            foreach ($showtimes->result() as $row) {
                $table[] = array($row->title, $row->name, $row->address, $row->date, $row->time, $row->available, anchor('main/displaySeats/' . $row->id, $row->id));
            }
            //Next step is to place our created array into a new array variable, one that we are sending to the view.
            $data['showtimes'] = $table;
        }

        //Now we are prepared to call the view, passing all the necessary variables inside the $data array
        $data['main'] = 'main/showtimes';
        $this->load->view('template', $data);
    }

    function populate() {
        $this->load->model('movie_model');
        $this->load->model('theater_model');
        $this->load->model('showtime_model');

        $this->movie_model->populate();
        $this->theater_model->populate();
        $this->showtime_model->populate();

        //Then we redirect to the index page again
        $data['main'] = 'main/adminview';
        $this->load->view('template', $data);
    }

    function showTickets() {

        //First we load the library and the model
        $this->load->library('table');
        $this->load->model('movie_model');
        $this->load->model('theater_model');
        $this->load->model('showtime_model');
        $this->load->model('ticket_model');

        //Then we call our model's get_showtimes function
        $tickets = $this->ticket_model->get_tickets();

        //Prepare the array that will contain the data
        $table = array();

        $table[] = array('Movie', 'Theater', 'Seat', 'First Name', 'Last Name', 'Credit Card Number', 'Credit Card Expiration Date');

        //If it returns some results we continue
        if ($tickets->num_rows() > 0) {

            foreach ($tickets->result() as $row) {
                $showTimeInfos = $this->showtime_model->get_showTimeWithId($row->showtime_id);
                if ($showTimeInfos->num_rows() > 0) {
                    foreach ($showTimeInfos->result() as $showTimeRow) {
                        $table[] = array($showTimeRow->title, $showTimeRow->name, $row->seat, $row->first, $row->last, $row->creditcardnumber, $row->creditcardexpiration);
                    }
                }
            }
            //Next step is to place our created array into a new array variable, one that we are sending to the view.
        }
        $data['tickets'] = $table;

        //Now we are prepared to call the view, passing all the necessary variables inside the $data array
        $data['main'] = 'main/ticketview';
        $this->load->view('template', $data);
    }

    function publishTicket() {
        $error = "";
        $this->load->model('ticket_model');
        $this->load->model('showtime_model');
        /* $a = array
          (
          'firstName' => 'Shaun',
          'lastName' => 'Kho',
          'creditCardNumber' => '1111222233334444',
          'creditCardExpirationDate' => '01/23',
          );
          $this->session->set_userdata($a); */
        $sessionDataArray = $this->session->all_userdata();
        echo 'before array key exist';
        if (array_key_exists("firstName", $sessionDataArray) && array_key_exists("lastName", $sessionDataArray) && array_key_exists("creditCardNumber", $sessionDataArray) && array_key_exists("creditCardExpirationDate", $sessionDataArray) && array_key_exists("showTimeId", $sessionDataArray) && array_key_exists("seat", $sessionDataArray)) {
            $firstName = $sessionDataArray['firstName'];
            $lastName = $sessionDataArray['lastName'];
            $creditCardNumber = $sessionDataArray['creditCardNumber'];
            $creditCardExpirationDate = $sessionDataArray['creditCardExpirationDate'];
            $showTimeId = $sessionDataArray['showTimeId'];
            $seat = $sessionDataArray['seat'];
            echo $firstName;
            echo $lastName;
            echo $creditCardNumber;
            echo $creditCardExpirationDate;
            echo $seat;
            echo $showTimeId;
            echo 'before validateShowTimeId';
            if ($this->ticket_model->validateShowTimeId($showTimeId)) {
                $query = $this->db->query('select date from showtime where id = ?', array($showTimeId));
                if ($query->num_rows() > 0) {
                    $queryResultArray = $query->result();
                    $showTimeDate = $queryResultArray[0]->date;
                    if ($this->ticket_model->validateCurrentDate($showTimeDate) && $this->ticket_model->validateCreditCardNumber($creditCardNumber) && $this->ticket_model->validateCreditCardExpirationDate($creditCardExpirationDate) && $this->ticket_model->validateName($firstName, $lastName) && $this->ticket_model->seatAvailable($showTimeId, $seat)) {
                        echo 'before insert';
                        $this->ticket_model->insertTicket($firstName, $lastName, $creditCardNumber, $creditCardExpirationDate, $showTimeId, $seat);

                        $data['main'] = 'main/receiptview';
                        $showtimeQuery = $this->showtime_model->get_showTimeWithIdWithDateAndTime($showTimeId);
                        if ($showtimeQuery->num_rows() > 0) {
                            $showtimeQueryResultArray = $showtimeQuery->result();
                            $data['movietitle'] = $showtimeQueryResultArray[0]->title;
                            $data['date'] = $showtimeQueryResultArray[0]->date;
                            $data['showtime'] = $showtimeQueryResultArray[0]->time;
                            $data['venue'] = $showtimeQueryResultArray[0]->name;
                        }

                        $data['price'] = 6;
                        $data['seat'] = $seat;
                        $data['firstname'] = $firstName;
                        $data['lastname'] = $lastName;
                        $data['creditcardnumber'] = $creditCardNumber;
                        $data['creditcardexpirationdate'] = $creditCardExpirationDate;

                        $this->load->view('template', $data);
                        return;
                    }
                    else{
                        $error = "One or more entries are invalid. ";
                    }
                }
                else{
                    $error = "This movie with the particular date and showtime is not found. ";
                }
            }
            else{
                $error = "This movie with the particular date and showtime is not valid. ";
            }
        }
        else{
            $error = "Some of the user data are not saved correctly. ";
        }
        $this->showSummaryViewWithError($error);
    }

    function deleteTickets() {
        $this->load->model('ticket_model');
        $this->ticket_model->deleteTickets();
        $data['main'] = 'main/adminview';
        $this->load->view('template', $data);
    }

    function delete() {
        $this->load->model('movie_model');
        $this->load->model('theater_model');
        $this->load->model('showtime_model');
        $this->load->model('ticket_model');

        $this->movie_model->delete();
        $this->theater_model->delete();
        $this->showtime_model->delete();
        $this->ticket_model->delete();

        $this->session->sess_destroy();
        //Then we redirect to the index page again
        $data['main'] = 'main/adminview';
        $this->load->view('template', $data);
    }

    function goBackFromUserInfoView() {
        $this->load->model('seat_model');
        $availableSeats = $this->seat_model->checkSeats();
        $data['seat1'] = $this->seat_model->whiteSquareUrl();
        $data['seat2'] = $this->seat_model->whiteSquareUrl();
        $data['seat3'] = $this->seat_model->whiteSquareUrl();
        if (!$availableSeats[0]) {
            $data['seat1'] = $this->seat_model->yellowSquareUrl();
        }
        if (!$availableSeats[1]) {
            $data['seat2'] = $this->seat_model->yellowSquareUrl();
        }
        if (!$availableSeats[2]) {
            $data['seat3'] = $this->seat_model->yellowSquareUrl();
        }
        $sessionDataArray = $this->session->all_userdata();
        if (array_key_exists("seat", $sessionDataArray)) {
            $chosenSeat = $sessionDataArray['seat'];
            if ($chosenSeat == 1) {
                $data['seat1'] = $this->seat_model->greenSquareUrl();
            } else if ($chosenSeat == 2) {
                $data['seat2'] = $this->seat_model->greenSquareUrl();
            } else if ($chosenSeat == 3) {
                $data['seat3'] = $this->seat_model->greenSquareUrl();
            }
        }
        $data['main'] = 'main/seatview';
        $this->load->view('template', $data);
    }

    function displaySeats($showTimeId) {
        $this->load->model('seat_model');
        $this->session->set_userdata('showTimeId', $showTimeId);
        $availableSeats = $this->seat_model->checkSeats();
        $data['seat1'] = $this->seat_model->whiteSquareUrl();
        $data['seat2'] = $this->seat_model->whiteSquareUrl();
        $data['seat3'] = $this->seat_model->whiteSquareUrl();
        if (!$availableSeats[0]) {
            $data['seat1'] = $this->seat_model->yellowSquareUrl();
        }
        if (!$availableSeats[1]) {
            $data['seat2'] = $this->seat_model->yellowSquareUrl();
        }
        if (!$availableSeats[2]) {
            $data['seat3'] = $this->seat_model->yellowSquareUrl();
        }
        $data['main'] = 'main/seatview';
        $this->load->view('template', $data);
    }

    function displaySeatsWithError($error) {
        $this->load->model('seat_model');
        $sessionDataArray = $this->session->all_userdata();
        echo 'before array key exist';
        $showTimeId = 0;
        if (array_key_exists("showTimeId", $sessionDataArray)) {
            $showTimeId = $sessionDataArray['showTimeId'];
        } else {
            $this->goBackFromSeatView();
            return;
        }
        $data['seatError'] = $error;
        $availableSeats = $this->seat_model->checkSeats();
        $data['seat1'] = $this->seat_model->whiteSquareUrl();
        $data['seat2'] = $this->seat_model->whiteSquareUrl();
        $data['seat3'] = $this->seat_model->whiteSquareUrl();
        if (!$availableSeats[0]) {
            $data['seat1'] = $this->seat_model->yellowSquareUrl();
        }
        if (!$availableSeats[1]) {
            $data['seat2'] = $this->seat_model->yellowSquareUrl();
        }
        if (!$availableSeats[2]) {
            $data['seat3'] = $this->seat_model->yellowSquareUrl();
        }
        $data['main'] = 'main/seatview';
        $this->load->view('template', $data);
    }

    function seatSelected($seat) {
        //echo "hello world asdf";
        $this->load->model('seat_model');
        $availableSeats = $this->seat_model->checkSeats();
        if ($seat >= 1 && $seat <= 3) {
            if ($availableSeats[$seat - 1]) {
                $this->session->set_userdata('seat', $seat);
                //echo "hello world";
                $this->showUserInfoForm();
                return;
            } else {
                $this->displaySeatsWithError("Seat is not available. Please select a valid seat. ");
            }
        } else {
            $this->displaySeatsWithError("No seat is selected. Please select a seat.");
        }
    }

    function showUserInfoForm() {
        $sessionDataArray = $this->session->all_userdata();
        if (array_key_exists("firstName", $sessionDataArray)) {
            $data["firstName"] = $sessionDataArray['firstName'];
        }
        if (array_key_exists("lastName", $sessionDataArray)) {
            $data["lastName"] = $sessionDataArray['lastName'];
        }
        if (array_key_exists("creditCardNumber", $sessionDataArray)) {
            $data["creditCardNumber"] = $sessionDataArray['creditCardNumber'];
        }
        if (array_key_exists("creditCardExpirationDate", $sessionDataArray)) {
            $expDate = $sessionDataArray['creditCardExpirationDate'];
            $data['creditCardExpirationMonth'] = substr($expDate, 0, 2);
            $data['creditCardExpirationYear'] = substr($expDate, 3, 2);
        }
        $data['main'] = 'main/userinfoview';
        $this->load->view('template', $data);
    }

    function showUserInfoFormWithError($errorCode) {
        foreach ($errorCode as $key => $value) {
            $data[$key] = $value;
        }
        $sessionDataArray = $this->session->all_userdata();
        if (array_key_exists("firstName", $sessionDataArray)) {
            $data["firstName"] = $sessionDataArray['firstName'];
        }
        if (array_key_exists("lastName", $sessionDataArray)) {
            $data["lastName"] = $sessionDataArray['lastName'];
        }
        if (array_key_exists("creditCardNumber", $sessionDataArray)) {
            $data["creditCardNumber"] = $sessionDataArray['creditCardNumber'];
        }
        if (array_key_exists("creditCardExpirationDate", $sessionDataArray)) {
            $expDate = $sessionDataArray['creditCardExpirationDate'];
            $data['creditCardExpirationMonth'] = substr($expDate, 0, 2);
            $data['creditCardExpirationYear'] = substr($expDate, 3, 2);
        }
        $data['main'] = 'main/userinfoview';
        $this->load->view('template', $data);
    }

    function validateUserForm($firstName, $lastName, $creditCardNumber, $creditCardExpirationMonth, $creditCardExpirationYear) {
        $this->load->model('ticket_model');
        $errorCode = array();
        $month = (string) $creditCardExpirationMonth;
        $year = (string) $creditCardExpirationYear;
        $creditCardExpirationDate = $month . "/" . $year;
        $checkDate = true;
        $checkMonth = true;
        $checkYear = true;
        if (!is_numeric($creditCardExpirationMonth)) {
            if (array_key_exists("creditCardExpirationDateError", $errorCode)) {
                $errorCode["creditCardExpirationDateError"] = $errorCode["creditCardExpirationDateError"] . "Also, Credit Card Expiration Month is not a number. ";
            } else {
                $errorCode["creditCardExpirationDateError"] = "Credit Card Expiration Month is not a number. ";
            }
            $checkMonth = false;
            $checkDate = false;
        }
        if (!is_numeric($creditCardExpirationYear)) {
            if (array_key_exists("creditCardExpirationDateError", $errorCode)) {
                $errorCode["creditCardExpirationDateError"] = $errorCode["creditCardExpirationDateError"] . "Also, Credit Card Expiration Year is not a number. ";
            } else {
                $errorCode["creditCardExpirationDateError"] = "Credit Card Expiration Year is not a number. ";
            }
            $checkYear = false;
            $checkDate = false;
        }

        if ($checkMonth) {
            if ($creditCardExpirationMonth < 1 || $creditCardExpirationMonth > 12) {
                if (array_key_exists("creditCardExpirationDateError", $errorCode)) {
                    $errorCode["creditCardExpirationDateError"] = $errorCode["creditCardExpirationDateError"] . "Also, Credit Card Expiration Month is not in range. ";
                } else {
                    $errorCode["creditCardExpirationDateError"] = "Credit Card Expiration Month is not in range. ";
                }
                $checkDate = false;
            }
        }

        if ($checkYear) {
            if ($creditCardExpirationYear <= 0) {
                if (array_key_exists("creditCardExpirationDateError", $errorCode)) {
                    $errorCode["creditCardExpirationDateError"] = $errorCode["creditCardExpirationDateError"] . "Also, Credit Card Expiration Year is not in range. ";
                } else {
                    $errorCode["creditCardExpirationDateError"] = "Credit Card Expiration Year is not in range. ";
                }
                $checkDate = false;
            }
        }


        if ($checkDate) {

            if (!$this->ticket_model->validateCreditCardExpirationDate($creditCardExpirationDate)) {
                if (array_key_exists("creditCardExpirationDateError", $errorCode)) {
                    $errorCode["creditCardExpirationDateError"] = $errorCode["creditCardExpirationDateError"] . "Also, Credit Card Expiration Date is not valid. ";
                } else {
                    $errorCode["creditCardExpirationDateError"] = "Credit Card Expiration Date is not valid. ";
                }
            }
        }

        if (!$this->ticket_model->validateCreditCardNumber($creditCardNumber)) {
            $errorCode["creditCardNumberError"] = "Credit Card Number is not valid.";
        }

        if (!$this->ticket_model->validateName($firstName, $lastName)) {
            $errorCode["firstNameError"] = "First or Last name is not valid.";
            $errorCode["lastNameError"] = "First or Last name is not valid.";
        }

        $a = array
            (
            'firstName' => $firstName,
            'lastName' => $lastName,
            'creditCardNumber' => $creditCardNumber,
            'creditCardExpirationDate' => $creditCardExpirationDate,
        );

        $this->session->set_userdata($a);

        if (count($errorCode) > 0) {
            $this->showUserInfoFormWithError($errorCode);
            return;
        }

        $this->showSummaryView();
    }

    function goBackFromSeatView() {
        $sessionDataArray = $this->session->all_userdata();
        if (array_key_exists("showTimeId", $sessionDataArray)) {
            $this->session->unset_userdata("showTimeId");
        }
        if (array_key_exists("seat", $sessionDataArray)) {
            $this->session->unset_userdata("seat");
        }
        redirect('', 'refresh');
    }

    function showSummaryView() {
        $this->load->model('showtime_model');
        $sessionDataArray = $this->session->all_userdata();
        if (array_key_exists("showTimeId", $sessionDataArray)) {
            $showTimeId = $sessionDataArray["showTimeId"];
            $showtimes = $this->showtime_model->get_showTimeWithIdWithDateAndTime($showTimeId);

            //If it returns some results we continue
            if ($showtimes->num_rows() > 0) {
                $result = $showtimes->result();
                $data["movietitle"] = $result[0]->title;
                $data["date"] = $result[0]->date;
                $data["showtime"] = $result[0]->time;
                $data["venue"] = $result[0]->name;
            } else {
                $this->goBackFromSeatView();
            }
        } else {
            $this->goBackFromSeatView();
            return;
        }
        $data["price"] = 6;
        if (array_key_exists("seat", $sessionDataArray)) {
            $data["seat"] = $sessionDataArray["seat"];
        }
        if (array_key_exists("firstName", $sessionDataArray)) {
            $data["firstname"] = $sessionDataArray["firstName"];
        }
        if (array_key_exists("lastName", $sessionDataArray)) {
            $data["lastname"] = $sessionDataArray["lastName"];
        }
        if (array_key_exists("creditCardNumber", $sessionDataArray)) {
            $data["creditcardnumber"] = $sessionDataArray["creditCardNumber"];
        }
        if (array_key_exists("creditCardExpirationDate", $sessionDataArray)) {
            $data["creditcardexpirationdate"] = $sessionDataArray["creditCardExpirationDate"];
        }
        $data['main'] = 'main/summaryview';
        $this->load->view('template', $data);
    }
    
    function showSummaryViewWithError($error) {
        $data["error"] = $error;
        $this->load->model('showtime_model');
        $sessionDataArray = $this->session->all_userdata();
        if (array_key_exists("showTimeId", $sessionDataArray)) {
            $showTimeId = $sessionDataArray["showTimeId"];
            $showtimes = $this->showtime_model->get_showTimeWithIdWithDateAndTime($showTimeId);

            //If it returns some results we continue
            if ($showtimes->num_rows() > 0) {
                $result = $showtimes->result();
                $data["movietitle"] = $result[0]->title;
                $data["date"] = $result[0]->date;
                $data["showtime"] = $result[0]->time;
                $data["venue"] = $result[0]->name;
            }
        }
        $data["price"] = 6;
        if (array_key_exists("seat", $sessionDataArray)) {
            $data["seat"] = $sessionDataArray["seat"];
        }
        if (array_key_exists("firstName", $sessionDataArray)) {
            $data["firstname"] = $sessionDataArray["firstName"];
        }
        if (array_key_exists("lastName", $sessionDataArray)) {
            $data["lastname"] = $sessionDataArray["lastName"];
        }
        if (array_key_exists("creditCardNumber", $sessionDataArray)) {
            $data["creditcardnumber"] = $sessionDataArray["creditCardNumber"];
        }
        if (array_key_exists("creditCardExpirationDate", $sessionDataArray)) {
            $data["creditcardexpirationdate"] = $sessionDataArray["creditCardExpirationDate"];
        }
        $data['main'] = 'main/summaryview';
        $this->load->view('template', $data);
    }

}

