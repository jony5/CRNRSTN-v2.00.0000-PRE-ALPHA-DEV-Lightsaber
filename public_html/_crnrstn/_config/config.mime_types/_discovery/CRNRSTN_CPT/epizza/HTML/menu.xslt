<?xml version="1.0" encoding="iso-8859-1"?><!-- DWXMLSource="xml/menu.xml" --><!DOCTYPE xsl:stylesheet  [
	<!ENTITY nbsp   "&#160;">
	<!ENTITY copy   "&#169;">
	<!ENTITY reg    "&#174;">
	<!ENTITY trade  "&#8482;">
	<!ENTITY mdash  "&#8212;">
	<!ENTITY ldquo  "&#8220;">
	<!ENTITY rdquo  "&#8221;"> 
	<!ENTITY pound  "&#163;">
	<!ENTITY yen    "&#165;">
	<!ENTITY euro   "&#8364;">
]>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="iso-8859-1" doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>
<xsl:template match="/">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title>Everybodies Pizza - Menu</title>
</head>

<body>
<h2 align="center">everybody's pizza</h2>
<p>Here are summaries of nutrition facts for several foods.
They are based on these daily values:</p>
<xsl:apply-templates select="daily-values"/>
<hr width="80%" />
<xsl:apply-templates select="food"/>

</body>
</html>

</xsl:template>
</xsl:stylesheet>