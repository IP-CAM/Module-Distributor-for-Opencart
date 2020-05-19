<?php

$template = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<modification>
  <name>
    <![CDATA[ Put Name ]]>
  </name>
  <version> Put Version </version>
  <link>digital-elephant.com.ua</link>
  <author>
    <![CDATA[<b>studio@digital.elephant.com.ua</b>]]>
  </author>
  <code> Code </code>
  <description>
    <![CDATA[ Description ]]>
  </description>
    {modifications}
</modification>
EOF;

$mods_2101_2302 = <<<EOF
    <file path="catalog/view/theme/*/template/product/category.tpl">
        <operation>
          <search trim="true">
            <![CDATA[\$results]]>
          </search>
          <add position="replace" trim="false">
            <![CDATA['<span id="pagination-text">' . \$results . '</span>']]>
          </add>
        </operation>

        <operation>
          <search trim="true">
            <![CDATA[\$pagination]]>
          </search>
          <add position="replace" trim="false">
            <![CDATA['<span id="products-pagination">' . \$pagination . '</span>']]>
          </add>
        </operation>
  </file>
EOF;

$mods_3000_3020 = <<<EOF
    <file path="catalog/view/theme/*/template/product/category.twig">
      <operation>
         <search trim="true"><![CDATA[{{ results }}]]></search>
         <add position="replace" trim="false"><![CDATA[<span id="pagination-text">{{ results }}</span>]]></add>
      </operation>
      <operation>
         <search trim="true"><![CDATA[{{ pagination }}]]></search>
         <add position="replace" trim="false"><![CDATA[<span id="products-pagination">{{ pagination }}</span>]]></add>
      </operation>
   </file>
   <file path="system/library/cache/file.php">
      <operation>
         <search trim="true"><![CDATA[unlink(\$file);]]></search>
         <add position="replace" trim="false"><![CDATA[@unlink(\$file);]]></add>
      </operation>
   </file>
EOF;

return [
    'template' => $template,
    'modifications' => [
        '2101:2302' => $mods_2101_2302,
        '3000:3020' => $mods_3000_3020
    ],
];