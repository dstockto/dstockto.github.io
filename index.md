Articles
------------
The articles below originally appeared in PHP Architect magazine in a month column I wrote for two and a half years.

<ul>
  {% for post in site.posts %}
    <li>
      <a href="{{ post.url }}">{{ post.title }}</a>
    </li>
  {% endfor %}
</ul>
[January 2015 - Leveling Up: Using a Debugger](/2015/01/01/Leveling-Up-Using-A-Debugger)