# faker-api

The API for the Faker group of web develpoment tools. 

```
soffice --headless --convert-to ppt:writer_ppt_Export --outdir ./pdf codeadam.pdf  
soffice --headless --convert-to ppt:writer_ppt_Export --outdir file:///Users/ codeadam.pdf  
soffice --infilter="writer_pdf_import" --headless --convert-to ppt codeadam.pdf
soffice --infilter="impress_pdf_import" --convert-to pptx source.pdf  
```

```
127.0.0.1 local.faker.ca
127.0.0.1 local.api.faker.ca
127.0.0.1 local.console.faker.ca
```

```
NameVirtualHost *:7777

<VirtualHost *:7777>
DocumentRoot "/Users/adam/Desktop/CodeAdam/faker-console-v1/public"
ServerName local.console.faker.ca
</VirtualHost>

<VirtualHost *:7777>
DocumentRoot "/Users/adam/Desktop/CodeAdam/faker-v1"
ServerName local.faker.ca
</VirtualHost>

<VirtualHost *:7777>
DocumentRoot "/Users/adam/Desktop/CodeAdam/faker-api-v1/public"
ServerName local.api.faker.ca
</VirtualHost>
```
