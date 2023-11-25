<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	version="1.0">

<xsl:output method="text"/>

<xsl:variable name="newline"><xsl:text>
</xsl:text></xsl:variable>
<xsl:variable name="tab"><xsl:text>&#x09;</xsl:text></xsl:variable>

<!-- category names -->
<xsl:template match="nutrition">
<xsl:text>Name&#x09;Manufacturer&#x09;Serving Size&#x09;</xsl:text>
<xsl:text>Serving Units&#x09;Total Calories&#x09;</xsl:text>
<xsl:text>Calories from Fat&#x09;Total Fat&#x09;</xsl:text>
<xsl:text>Saturated Fat&#x09;Cholesterol&#x09;</xsl:text>
<xsl:text>Sodium&#x09;Carbohydrates&#x09;Fiber&#x09;</xsl:text>
<xsl:text>Protein&#x09;Vitamin A&#x09;Vitamin C&#x09;</xsl:text>
<xsl:text>Calcium&#x09;Iron</xsl:text>
<xsl:value-of select="$newline"/>

<!-- daily values; fake the headers -->
<xsl:text>Daily Values&#x09;N/A&#x09;N/A&#x09;N/A&#x09;</xsl:text>
<xsl:text>N/A&#x09;N/A&#x09;</xsl:text>
<xsl:value-of select="daily-values/total-fat"/>
<xsl:value-of select="$tab"/>
<xsl:value-of select="daily-values/saturated-fat"/>
<xsl:value-of select="$tab"/>
<xsl:value-of select="daily-values/cholesterol"/>
<xsl:value-of select="$tab"/>
<xsl:value-of select="daily-values/sodium"/>
<xsl:value-of select="$tab"/>
<xsl:value-of select="daily-values/carb"/>
<xsl:value-of select="$tab"/>
<xsl:value-of select="daily-values/fiber"/>
<xsl:value-of select="$tab"/>
<xsl:value-of select="daily-values/protein"/>
<xsl:value-of select="$tab"/>
<!-- vitamins/minerals -->
<xsl:text>100&#x09;100&#x09;100&#x09;100</xsl:text>
<xsl:value-of select="$newline"/>

<xsl:apply-templates select="food"/>
</xsl:template>

<xsl:template match="food">
<xsl:value-of select="name"/><xsl:value-of select="$tab"/>
<xsl:value-of select="mfr"/><xsl:value-of select="$tab"/>
<xsl:value-of select="serving"/><xsl:value-of select="$tab"/>
<xsl:value-of select="serving/@units"/><xsl:value-of select="$tab"/>
<xsl:value-of select="calories/@total"/><xsl:value-of select="$tab"/>
<xsl:value-of select="calories/@fat"/><xsl:value-of select="$tab"/>
<xsl:value-of select="total-fat"/><xsl:value-of select="$tab"/>
<xsl:value-of select="saturated-fat"/><xsl:value-of select="$tab"/>
<xsl:value-of select="cholesterol"/><xsl:value-of select="$tab"/>
<xsl:value-of select="sodium"/><xsl:value-of select="$tab"/>
<xsl:value-of select="carb"/><xsl:value-of select="$tab"/>
<xsl:value-of select="fiber"/><xsl:value-of select="$tab"/>
<xsl:value-of select="protein"/><xsl:value-of select="$tab"/>
<xsl:value-of select="vitamins/a"/><xsl:value-of select="$tab"/>
<xsl:value-of select="vitamins/c"/><xsl:value-of select="$tab"/>
<xsl:value-of select="minerals/ca"/><xsl:value-of select="$tab"/>
<xsl:value-of select="minerals/fe"/><xsl:value-of select="$newline"/>
</xsl:template>

</xsl:stylesheet>
