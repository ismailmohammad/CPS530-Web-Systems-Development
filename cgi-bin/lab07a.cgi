#!/usr/bin/perl
use CGI ':standard';
print "Content-type: text/html\n\n";
$page = new CGI;
print $page->start_html(
   -title =>"Lab 7 - Perl: A",
   -head => [
      Link( { -href => 'https://cs.torontomu.ca/~mnismail/cps530/lab6/downloadedBootstrap.css', -rel => 'stylesheet', -type => 'text/css'}),
      Link( { -href => 'https://cs.torontomu.ca/~mnismail/cps530/lab7/a/a.css', -rel => 'stylesheet', -type => 'text/css'}),
      Link( { -href => 'https://fonts.googleapis.com', -rel => 'preconnect'}),
      Link( { -href => 'https://fonts.gstatic.com', -rel => 'preconnect'}),
      Link( { -href => 'https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap', -rel => 'stylesheet'}),
    ]
);
print qq(<div class="container">
            <div class="card shadow problem">
                <div class="card-body">
                    <div class="card shadow inner-card">
                        <h1 class="title">This is my first Perl program</h1>
                    </div>
                </div>
            </div>
            <h2 class="vanishimo">Hope you have a good day!</h2>
            <img class="vanishimo cat inner-card" src="https://media.tenor.com/NjbLQCvQoC8AAAAC/bongo-cat.gif" />
        </div>);