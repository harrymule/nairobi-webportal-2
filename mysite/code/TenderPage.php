<?php

class TenderPage extends Page {

	// We can use the $db array to add extra fields to the database.
	private static $db = array(
        'TendorNo' => 'Text',
        'TenderName' => 'Text',
        'StartDate' => 'Date',
        'EndDate' => 'Date',
        // 'Duration' => 'Text',
        "IconType" => "Text"
    );

    static $has_one = array ( 
		'TenderDocument' => 'File'
	);

	// Some defaults
    // private static $icon = "themes/fitiimage/images/icons/games.png";
	private static $description = "Use this to add tenders";
	private static $singular_name = 'Tender Page';
	private static $plural_name = 'Tender Pages';

	static $defaults = array(
        'bgColor' => 'green', 
        'IconType' => 'fa-bookmark'
    );

    public function populateDefaults() {
        $this->setField('bgColor', 'grey');
        $this->setField('IconType', 'fa-file');
        $this->Date = date('dd/mm/YYYY');
        parent::populateDefaults();
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', new TextField('TenderName', 'Tender Name'), 'Content');
        $fields->addFieldToTab('Root.Main', new TextField('TenderNo', 'Tender No.'), 'Content');
        // $fields->addFieldToTab('Root.Main', new TextField('Description'), 'Content');

        $startDateField = new DateField('StartDate', 'Tender Submission Start Date (for example: 20/12/2010)');  //Param 1 Date == Name of //Date field as declared in the $db array
        $startDateField->setConfig('showcalendar', true);
        $startDateField->setConfig('dateformat', 'dd/MM/YYYY');
        $fields->addFieldToTab('Root.Main', $startDateField, 'Content');

        $endDateField = new DateField('EndDate', 'Tender Submission End Date');  //Param 1 Date == Name of //Date field as declared in the $db array
        $endDateField->setConfig('showcalendar', true);
        $endDateField->setConfig('dateformat', 'dd/MM/YYYY');
        $fields->addFieldToTab('Root.Main', $endDateField, 'Content');

        $fields->addFieldToTab('Root.Main', new TextField('IconType', 'Icon Type'), 'Content');
        $fields->addFieldToTab("Root.Document", new UploadField('TenderDocument', 'Attach Detailed Tender Document'));

        $this->extend('updateCMSFields', $fields);
        return $fields;
    }

}

class TenderPage_Controller extends Page_Controller {
	// function init() {
	// 	parent::init();
	// 	Requirements::themedCSS("gallery_page");
	// }
}