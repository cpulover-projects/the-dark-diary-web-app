# Issues
- Frontend: 
  - Right topbar
  - Mobile responsive
  - Fixed sidebar
- Cookie not set
- Could not display PHP errors on the browser properly
- Could not link images in CSS from other directories
- Refresh form when delete current note
- Lost data of current note when reloading page

# Notes - Tips
- Create hidden fields in the forms to distinguish between signing up and signing in
- Hash password when signing up
- Use ```isset()``` to check availability of a key
- Add important style using jQuery: ```attr('style', function(i,s) { return (s || '') + 'background-color: aquamarine !important;' });```
- Select element inside "this" with jQuery: ```$(this).find('<element>')```