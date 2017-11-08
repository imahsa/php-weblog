function convertXmlToJqueryObj () {
	var xml = $('#xml');
	var xml_text = xml.html();
	//convert text xml to jquery obejct 
	var $xml = $(xml_text);
	xml.remove();
	return $xml;
}