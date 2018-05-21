Articles
------------
The articles below originally appeared in PHP Architect magazine in a month column I wrote for two and a half years.

<ul>
  {% for post in site.posts %}
    <li>
      <a href="{{ post.url }}">{{ post.title }} - {{ post.date }}</a>
    </li>
  {% endfor %}
</ul>