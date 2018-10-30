{# src/OC/PlatformBundle/Resources/view/Publication/add.html.twig #}

{% if not advert.categories.empty %}
  <p>
    Cette annonce est parue dans les catégories suivantes :
    {% for category in advert.categories %}
      {{ category.name }}{% if not loop.last %}, {% endif %}
    {% endfor %}
  </p>
{% endif %}