# camagru

This web project is challenging you to create a small web application allowing to make
basic video editing using your webcam and some predefined images.

 User features
• The application should allow a user to sign up by asking at least for an email, a
password with at least a minimum level of complexity. At the end of the sign-up
process a confirmation email should ve sent to the user in order to validate the
sign-up process.
• The user should then be able to connect using his username and his password. This
user also should be able to receive an email for resetting his password in case he
forgot it.
• The user should be able to disconnect in one click at any time on any page.

 Editing features
This part should be accessible only to users that are authentified/connected and gently
reject all other users that attempt to access it without being successfully logged in.
This page should contain 2 sections:
• A main section containing the preview of the user’s webcam, the list of superposable
images and a button allowing to capture a picture.
• A side section displaying thumbnails of all previous pictures taken.
Your page layout should normally look like in Figure IV.1.
• Superposable images must be selectable and the button allowing to take the picture
should be inactive (not clickable) as long as no superposable image has been
selected.
• The creation of the final image (so among others the superposing of the two images)
must be done on the server side, in PHP.
• Because not everyone has a webcam, you should allow the upload of a user image
instead of capturing one with the webcam.

 Web The Camagru Project
• The user should be able to delete his edited images, but only his, not other users’
creations.
 Gallery features
• This part is to be public and must display all the images edited by all the users,
ordered by date of creation. It should also allow (only) a connected user to like
them and/or comment them.
• When an image receives a new comment, the author of the image should be notified
by email.
• The list of images must be presented in successive pages (i.e. X images by page)
