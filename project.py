from project_module import project_object, image_object, link_object, challenge_object

p = project_object('indigo', 'i, short for indico')
p.domain = 'http://www.aidansean.com/'
p.path = 'indigo'
p.preview_image    = image_object('%s/images/project.jpg'   %p.path, 150, 250)
p.preview_image_bw = image_object('%s/images/project_bw.jpg'%p.path, 150, 250)
p.folder_name = 'aidansean'
p.github_repo_name = 'indigo'
p.mathjax = True
p.tags = 'Physics,Tools'
p.technologies = 'AJAX,CSS,HTML,JavaScript,PHP,ZeroClipboard'
p.links.append(link_object(p.domain, 'indigo', 'Live page'))
p.introduction = 'At CERN we used a meeting orgnisation system called indico.  Each meeting had a unique ID that was used to identify the resourcs associated with it.  In many instances there were times when a person had to access a meeting page when they only knew the unique id, and not the full uri.  I made this tool to obtain the full uri, given only the meeting id.  Since this project shortens the uri for indico it is called "\(i\)", which leads to all kinds of puns.'
p.overview = '''The user can interact with \(i\) in two different ways.  They can enter the uri of a meeting page, a meeting category page, or a meeting resource, and it will return the shortened uri.  They can also enter a shortened uri to be redirected to the full uri.

When the user enters a full uri it get parsed and strings are replaced to get a short uri.  They then have the option to copy the short uri with the use of ZeroClipboard.

When they user enters a short uri the HTTP request is captured using rewrite rules in <code>.htacces</code> or <code>web.config</code>.  They are then parsed and strings replaced to give the full uri.

The domain names are matched against known domain names to make the uris even shorter.  This limits the versatility of the tool, but to include custom domain names would result in strings which were almost as long and difficult to remember as the original long uris.  users can download and extend \(i\) to include any domains they want, and instructions to do with are given in the dev page.'''

p.challenges.append(challenge_object('The user should be able to copy the short uri with a single click.', 'This was the first project where I used ZeroClipboard to enable the user to copy with one click.  It is not a solution I am completely happy with, as it takes the control away from Javascript, which is appropriately sandboxed.  However the content that is handled with flash is harmless, so there are no security issues using ZeroClipboard.', 'Resolved'))

p.challenges.append(challenge_object('The tool must be usable by users who do not use flash or Javascript.', 'In order to use the tool, the user must interact using HTTP requests.  This ensures that the user can always use the tool even if they disable flash and Javascrpt.', 'Resolved'))

p.challenges.append(challenge_object('This tool should be extendable to suit different hosts and domain names.', 'Users are encouraged to assist with the development of \(i\), and with the GitHub repository they can be download and develop their own copy.', 'Resolved'))
