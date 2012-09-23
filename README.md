PACMAN
=======================
Password & ACcount MANager

Introduction
------------
This application is meant to store, retrieve and distribute passwords and account
information. It is meant to be used in a multi-user multi-project environment, 
and focuses on security (d'oh) by e.g. employing PGP, a defense in depth
architecture and auditing functionality.

PACMAN is distributed under the three-clause license (see License.txt).
Please contact us if you require a different license. The application uses
several Open Source components:
* Zend Framework 2, BSD Licensed   http://framework.zend.com
* Openpgpjs, GPLv2                 http://openpgpjs.org/
* PHP, PHP License v3.01           http:/php.net

WIP
---
In 2004 an application (referred to as Pacman v1) was written and has been in
use at Enrise (www.enrise.com) ever since. Because the application lacks certain
functionality, usability and security it was decided to start from scratch
(Sept. 2012).

Currently this means that PACMAN is still under development, and that the features
and mechanisms described may not have been realized yet. Feel free to contribute
or just take a look at the code, but be sure to NOT USE THIS IN PRODUCTION YET.

Key Features
------------
* Zend Framework 2 based [DONE]
* Endorse use of Principle of Least Privilege (secure by design).
* Allow for a Defense in Depth architecture where at least two components need
to be compromised for an attack to be effective.
* Group account information on a per-project, per environment
(development, testing, production, etc) basis.
* Allowing to group account information by server.
* Grant access to a user per project and environment.
* Save all sensitive information using PGP.
* Allow ordinary users to grant other users per project and environment.
* Distribute user's public SSH keys to the servers they have access to.
* Extensive audit logging, allowing for backends like IRC or SYSLOG
(yes, in that order).
* Possiblity to have ordinary users acknowledge audit log entries.
* Support temporary access grants.
* Support two-factor login
* Use an LDAP server as login backend.
* Allow to save private keys in a browser's local Storage, but not forcing
them to.
* Allow programmatic retrieval of specific passwords, designed for
software deployment processes.

Future ideas
------------
Some other ideas that'd be helpful are:
* Compatibility with Keepass
* <moreToCome>


Security oversight
------------------
PACMAN will consist out of multiple components:
* User
* Browser, optionally having stored the user's private PGP key in its local storage,
secured by a password (keyring construction).
* The main web-application
* The (Mysql/Mariadb) database. Could be installed on the same server as the web-
application.  
* The Key-server. A machine dedicated to encrypting credentials. Although possible
in development environments, the key-server application should _never_ be installed
on the same server as the main application. A private, dedicated, PGP key is
installed on this machine. All communication with the Key Server is done via the
main application.

When a user logs in his credentials are checked via the backend (ldap or rdbms)
that is available. An optional two-factor mechanism is also used. The user browses
the projects and their environments (this is considered nonsensitive information).
When a user wants to see a pair of credentials an audit log entry is created and sent
to a remote syslog server (if available). The PGP encrypted file that contains the
credentials is then sent to the browser. In the browser's local storage is a private
pgp key that, once the keyring is unlocked, is used by the browser to decrypt the
PGP file and display the password in place.

If a new password is added or privileges are changed, the password needs to be
re-encrypted. Herefore, the browser encrypts the password with the public pgp
key of the key server. This allows the key server to encrypt it with the user's
that should be able to open it their public keys. Because the client should be
considered the weakest link in the component chain it was chosen not to place
this responsibility at the client. Of course, these actions are auditlogged as well.


Review
~~~~~~
Although every choice in designing this software has been done with security
in mind, the application was still written by people (who by definition make
mistakes). Therefore any (security) review is welcome. If you've found anything
serious please disclose responsibly.


Installation
------------
You can install using native git submodules:

    git clone git://github.com/Enrise/Pacman.git --recursive

Virtual Host
------------
Afterwards, set up a virtual host to point to the public/ directory of the
project and you should be ready to go! (of course, for development only)

Disclaimer
----------
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
