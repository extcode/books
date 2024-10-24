.. include:: ../../Includes.rst.txt

.. _installation:

============
Installation
============

.. _installation_extension:

Install the extension
=====================

Depending on your needs you have three options to install the extension.

Installation using Composer
---------------------------

The recommended way to install the extension is by using `Composer <https://getcomposer.org/>`_.
In your Composer based TYPO3 project root, just do

`composer require extcode/books`.

Installation from TYPO3 Extension Repository (TER)
--------------------------------------------------

Download and install the extension with the extension manager module.

Latest version from git
-----------------------
You can get the latest version from git by using the git command:

.. code-block:: bash

   git clone git@github.com:extcode/books.git

.. _installation_typoscript:

Include TypoScript
==================

The extension ships some TypoScript code which needs to be included.
There are two valid ways to do this:

Preparation: Include static TypoScript
--------------------------------------

#. Switch to the root page of your site.

#. Switch to the **Template module** and select *Info/Modify*.

#. Press the link **Edit the whole template record** and switch to the tab *Includes*.

#. Select **Books** at the field *Include static (from extensions):*

Include TypoScript via SitePackage
----------------------------------
This way is preferred because the configuration is under version control.

#. Add :typoscript:`@import 'EXT:books/Configuration/TypoScript/setup.typoscript'`
   to your  `sitepackage/Configuration/TypoScript/setup.typoscript`
