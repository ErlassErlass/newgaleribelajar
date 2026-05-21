try:
    import fitz
    doc = fitz.open(r'c:\laragon\www\galeribelajar\Konsep Redesign Website galeribelajar.com.pdf')
    text = "".join(page.get_text() for page in doc)
    with open('pdf_output.txt', 'w', encoding='utf-8') as f:
        f.write(text)
except ImportError:
    try:
        import PyPDF2
        reader = PyPDF2.PdfReader(r'c:\laragon\www\galeribelajar\Konsep Redesign Website galeribelajar.com.pdf')
        text = "\n".join(page.extract_text() for page in reader.pages)
        with open('pdf_output.txt', 'w', encoding='utf-8') as f:
            f.write(text)
    except Exception as e:
        print(f"Error: {e}")
