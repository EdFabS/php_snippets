from pdf2image.exceptions import (
    PDFInfoNotInstalledError,
    PDFPageCountError,
    PDFSyntaxError
)

from pdf2image import convert_from_path
pages = convert_from_path('ayudante.pdf', 436)

for page in pages:
    page.save('out.jpg', 'JPEG')