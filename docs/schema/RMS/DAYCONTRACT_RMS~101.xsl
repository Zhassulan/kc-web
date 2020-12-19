<?xml version="1.0" encoding="Windows-1251"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:decimal-format decimal-separator="." grouping-separator="," />

  <xsl:template match="/">
    <html>

      <head>
        <title>
          <xsl:value-of select="/Receiver/Report/@Desc" />: <xsl:value-of select="/Receiver/@Id" /> �� <xsl:value-of select="/Receiver/@DateTo" />
        </title>
        <style>

          td
          {
          padding-top:1px;
          padding-right:3px;
          padding-bottom:1px;
          padding-left:3px;
          white-space:nowrap;
          }

          .np
          {
          padding-top:0px;
          padding-right:0px;
          padding-bottom:1px;
          padding-left:0px;
          }

          .sign1
          {
          font-size:7.0pt;
          font-weight:100;
          font-family:"Arial CYR", sans-serif;
          color:gray;
          text-align:center;
          vertical-align:bottom;
          white-space:normal;
          letter-spacing:2pt;
          }

          .sign2
          {
          font-size:7.0pt;
          font-weight:100;
          font-family:"Arial CYR", sans-serif;
          color:gray;
          text-align:center;
          vertical-align:top;
          white-space:normal;
          letter-spacing:2pt;
          }

          .sign3
          {
          color:gray;
          text-align:justify;
          vertical-align:top;
          border-top:.5pt solid gray;
          }

          .sign4
          {
          color:gray;
          text-align:left;
          vertical-align:middle;
          white-space:normal;
          }

          .sign5
          {
          color:gray;
          text-align:right;
          vertical-align:middle;
          white-space:normal;
          }

          .hdr01
          {
          font-size:8.0pt;
          font-weight:100;
          font-family:"Arial CYR", sans-serif;
          color:#315D84;
          text-align:center;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          background:#E7F2F4;
          white-space:normal;
          }

          .dat01
          {
          font-size:7.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:center;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          }

          .dat01_l
          {
          font-size:7.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:left;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          }

          .dat01_r
          {
          font-size:7.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:right;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          }

          .dat02
          {
          font-size:7.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:left;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          }

          .dat02L
          {
          font-size:8.0pt;
          font-weight:700;
          font-family:"Courier New CYR", monospace;
          letter-spacing:.5pt;
          text-align:left;
          vertical-align:middle;
          border-top:.5pt solid windowtext;
          border-right:.5pt solid windowtext;
          border-bottom:.5pt solid windowtext;
          border-left:.5pt solid windowtext;
          }

        </style>

      </head>

      <body>
        <xsl:apply-templates />
      </body>

    </html>
  </xsl:template>

  <xsl:template match="Receiver">

    <xsl:element name="table">
      <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

      <tr>
        <td colSpan="13" class="np">

          <xsl:element name="table">
            <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

            <col />
            <col width="100%" />
            <col />

            <tr>

              <td class="sign4" rowspan="2"><img src="http://ftp.ets.kz/Plaza/Schema/ets001.jpg" width="105" height="25" alt="submit"></img></td>

              <td class="sign1">������ �������� ������� � ����������� ���� � �������� ����������� �������� ��������</td>

              <td class="sign5" rowspan="2"><img src="http://ftp.ets.kz/Plaza/Schema/ets001.jpg" width="105" height="25" alt="submit"></img></td>

            </tr>

            <tr>
          <td class="sign2">������������ �������� "�������� ����� "����������� �������� �������"</td>
            </tr>

           <tr height="4" >
             <td class="np"></td>
           </tr>

            <tr height="20">
          <td class="sign3" colspan="3"></td>
            </tr>

          </xsl:element>

    </td>
      </tr>

      <tr>
        <td colSpan="13" class="np">

          <xsl:element name="table">
            <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

            <col width="20%" />
            <col />
            <col width="100%"/>
            <col />
            <col />

            <tr>
              <td class="hdr01" colspan="7">����������� �������� "�������� ����� "����������� �������� �������"</td>
            </tr>
            <tr>
              <td class="dat02L" colspan="7">
                <xsl:value-of select="Report/@Desc" />
              </td>
            </tr>
            <tr>
              <td class="hdr01">��������</td>
              <td class="dat02">
                <xsl:value-of select="@Id" />
              </td>
              <td class="dat01_l" colspan="2">
                <xsl:value-of select="@Name" />
              </td>
              <td class="dat01_l" colspan="2">
                <xsl:value-of select="@Inn" />
              </td>
            </tr>
            <tr>
              <td class="hdr01">���� ������</td>
              <td class="dat02">
                <xsl:value-of select="@DateTo" />
              </td>
              <td class="dat02" ></td>
              <td class="hdr01">�����������</td>
              <td class="dat02">
                <xsl:value-of select="@DateRpt" />
              </td>
            </tr>
          </xsl:element>
        </td>
      </tr>

      <xsl:apply-templates select="ClientGroup"/>

    </xsl:element>

  </xsl:template>

  <xsl:template match="ClientGroup">

    <xsl:apply-templates select="Client"/>

   </xsl:template>

  <xsl:template match="Client">

    <tr height="8" >
      <td colSpan="1" class="np"></td>
    </tr>

    <tr>
      <td colSpan="13" class="np">

        <xsl:element name="table">
          <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

          <tr>
            <td colSpan="1" class="hdr01">��� �������</td>
            <td colSpan="1" class="hdr01">��� �������</td>
            <td colSpan="1" class="hdr01">������������ �������</td>
            <td colSpan="1" class="hdr01">��������� ������� �� ����������� �����, �����</td>
            <td colSpan="1" class="hdr01">��������������� ������� �� ����������� �����, �����</td>
            <td colSpan="1" class="hdr01">������ ��, �����</td>
            <td colSpan="1" class="hdr01">��������������� ��, �����</td>
          </tr>

          <tr>
            <td colSpan="1" class="dat01">
              <xsl:value-of select="@ClientCode" />
            </td>
            <td colSpan="1" class="dat01">
              <xsl:value-of select="@Inn" />
            </td>
            <td colSpan="1" class="dat01">
              <xsl:value-of select="@ClientName" />
            </td>
            <td colSpan="1" class="dat01_r">
              <xsl:value-of select="format-number(../Delivery/@FreeAsset,'0.00')" />
            </td>
            <td colSpan="1" class="dat01_r">
              <xsl:value-of select="format-number(../Delivery/@BlockedAsset,'0.00')" />
            </td>
            <td colSpan="1" class="dat01_r">
              <xsl:value-of select="format-number(../Limit/@DepositLimit,'0.00')" />
            </td>
            <td colSpan="1" class="dat01_r">
              <xsl:value-of select="format-number(../Limit/@BlockedLimit,'0.00')" />
            </td>
          </tr>

        </xsl:element>
      </td>
    </tr>
    <tr>
      <td class="hdr01" >����� ������</td>
      <td class="hdr01" >��� �����</td>
      <td class="hdr01" >���� � ����� ����������� ������</td>
      <td class="hdr01" >���� ���������� ��������</td>
      <td class="hdr01" >���� ���������� �������� �������</td>
      <td class="hdr01" >���� �������� ������</td>
      <td class="hdr01" >������� / �������</td>
      <td class="hdr01" >��� ������</td>
      <td class="hdr01" >���-�� ������, � ��. ���. ������</td>
      <td class="hdr01" >������ ������</td>
      <td class="hdr01" >���� �� ������� ������</td>
      <td class="hdr01" >����� ������</td>
      <td class="hdr01" >������������� ��</td>
      <td class="hdr01" >���� ����������� ������������ ������������ ������</td>
      <td class="hdr01" >��� �����������</td>
      <td class="hdr01" >������������ �����������</td>
     </tr>

     <xsl:apply-templates select="Issue"/>


  </xsl:template>

  <xsl:template match="Issue">
    <xsl:apply-templates select="Contract"/>
  </xsl:template>



  <xsl:template match="Contract">
    <tr>

      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@Number" />
      </td>

      <td class="dat01">
        <xsl:choose>
          <xsl:when test="@MarketCode">
            <xsl:value-of select="@MarketCode" />
          </xsl:when>
        </xsl:choose>
      </td>

      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="@TradeMoment" />
      </td>

      <td colSpan="1" class="dat01_l">
        <xsl:choose>

          <xsl:when test="@HasAgreement[.='False']">
             <xsl:value-of select="@AgrDate" />
          </xsl:when>
          <xsl:when test="@HasAgreement[.='True']">
             <xsl:value-of select="@AgrDate" />
         <xsl:text> - Done</xsl:text>
          </xsl:when>

        </xsl:choose>
      </td>

      <td colSpan="1" class="dat01_l">
        <xsl:choose>
          <xsl:when test="@HasPayed[.='False']">
             <xsl:value-of select="@PaymentDate" />
          </xsl:when>
          <xsl:when test="@HasPayed[.='True']">
             <xsl:value-of select="@PaymentDate" />
         <xsl:text> - Done</xsl:text>
          </xsl:when>
        </xsl:choose>
      </td>

      <td colSpan="1" class="dat01_l">
        <xsl:choose>
          <xsl:when test="@HasDelivered[.='False']">
             <xsl:value-of select="@DeliveryDate" />
          </xsl:when>
          <xsl:when test="@HasDelivered[.='True']">
             <xsl:value-of select="@DeliveryDate" />
         <xsl:text> - Done</xsl:text>
          </xsl:when>
        </xsl:choose>
      </td>

      <td colSpan="1" class="dat01_l">

        <xsl:choose>

          <xsl:when test="@Action[.='P']">
            <xsl:text>�������</xsl:text>
          </xsl:when>
          <xsl:when test="@Action[.='S']">
            <xsl:text>�������</xsl:text>
          </xsl:when>

        </xsl:choose>

      </td>

      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="../@Code" />
      </td>

      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="@Qty" />
      </td>

      <td colSpan="1" class="dat01">
        <xsl:value-of select="@Currency" />
      </td>

      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="format-number(@Price,'0.00')" />
      </td>

      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="format-number(@PayAmt,'0.00')" />
      </td>

      <td colSpan="1" class="dat01_r">
        <xsl:value-of select="format-number(@DepositMargin,'0.00')" />
      </td>

      <td class="dat01">
        <xsl:choose>
          <xsl:when test="@ExecMoment">
            <xsl:value-of select="@ExecMoment" />
          </xsl:when>
        </xsl:choose>
      </td>

      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="CounterParty/@ContrCode" />
      </td>
      <td colSpan="1" class="dat01_l">
        <xsl:value-of select="CounterParty/@ContrName" />
      </td>

    </tr>

  </xsl:template>

</xsl:stylesheet>