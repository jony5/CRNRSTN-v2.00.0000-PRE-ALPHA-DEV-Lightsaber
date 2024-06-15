<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
<html>
<body>
<xsl:stylesheet>
<xsl:template match="/">
<xsl:apply-templates select="page/message"/>
</xsl:template>
<xsl:template match="page/message">
<div style="color:#000099; font-size:19px;">
<xsl:value-of select="."/>
</div>
</xsl:template>
</xsl:stylesheet>

</body>
</html>
</xsl:template>

</xsl:stylesheet>
