<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
	<html>
        <head>
            <title>Galderak Ikusi</title>
        </head>
        <body>
            <table border="1" >
                <tr bgcolor="#9acd32">
                    <th>Galdera</th>
                    <th>Konplexutasuna</th>
                    <th>Erantzun Zuzena</th>
		    <th>Bidaltzaile Emaila</th>
                </tr>
		<xsl:for-each select="/assessmentItems/assessmentItem">
                    <tr>
			<td><xsl:value-of select="itemBody"/></td>
                        <td><xsl:value-of select="@complexity"/></td>
                        <td><xsl:value-of select="correctResponse/value"/></td>
			<td><xsl:value-of select="senderEmail/value"/></td>
                    </tr>
                </xsl:for-each>
            </table>
	</body>
    </html>
</xsl:template>
</xsl:stylesheet>	