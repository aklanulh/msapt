import { useState } from 'react';
import { Calendar, User, Tag, ArrowRight, Clock, Eye } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';

const ArticlesSection = () => {
  const [selectedCategory, setSelectedCategory] = useState('all');

  const categories = [
    { id: 'all', label: 'All Articles', count: 24 },
    { id: 'tips', label: 'Riding Tips', count: 8 },
    { id: 'recaps', label: 'Event Recaps', count: 10 },
    { id: 'news', label: 'Motor News', count: 6 }
  ];

  const articles = [
    {
      id: 1,
      title: "Essential Motorcycle Maintenance Tips for Benelli Owners",
      excerpt: "Keep your Benelli running smoothly with these expert maintenance tips. From oil changes to brake inspections, learn the fundamentals every rider should know.",
      image: "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=400&fit=crop",
      category: "tips",
      author: "Doni Setiawan",
      date: "July 25, 2024",
      readTime: "5 min read",
      views: 1245
    },
    {
      id: 2,
      title: "Sunday Morning Ride to Puncak: A Brotherhood Adventure",
      excerpt: "Relive our amazing journey to Puncak with 30 BOI Bekasi members. Beautiful scenery, great company, and unforgettable memories along the way.",
      image: "https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=600&h=400&fit=crop",
      category: "recaps",
      author: "Lisa Maharani",
      date: "July 20, 2024",
      readTime: "3 min read",
      views: 892
    },
    {
      id: 3,
      title: "New Benelli TNT 600i 2024: First Impressions and Review",
      excerpt: "The latest iteration of Benelli's flagship naked bike brings improved performance and refined aesthetics. Here's our detailed first ride review.",
      image: "https://images.unsplash.com/photo-1609630875171-b1321377ee65?w=600&h=400&fit=crop",
      category: "news",
      author: "Ahmad Rizki",
      date: "July 18, 2024",
      readTime: "7 min read",
      views: 2103
    },
    {
      id: 4,
      title: "Safety First: Group Riding Etiquette and Best Practices",
      excerpt: "Learn the essential rules and communication signals for safe group riding. Every BOI member should master these fundamental safety practices.",
      image: "https://images.unsplash.com/photo-1558030006-450675ba526a?w=600&h=400&fit=crop",
      category: "tips",
      author: "Sari Dewi",
      date: "July 15, 2024",
      readTime: "6 min read",
      views: 1567
    },
    {
      id: 5,
      title: "Charity Ride Success: Supporting Local Education Initiative",
      excerpt: "Our recent charity ride raised significant funds for local schools. Read about the impact we made and meet the families we helped.",
      image: "https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=600&h=400&fit=crop",
      category: "recaps",
      author: "Diana Putri",
      date: "July 12, 2024",
      readTime: "4 min read",
      views: 756
    },
    {
      id: 6,
      title: "Benelli Indonesia Market Update: New Models Coming Soon",
      excerpt: "Exciting news from Benelli Indonesia! Get the inside scoop on upcoming models and what it means for the Indonesian motorcycle market.",
      image: "https://images.unsplash.com/photo-1567046207633-0a02b63db7d4?w=600&h=400&fit=crop",
      category: "news",
      author: "Budi Santoso",
      date: "July 10, 2024",
      readTime: "5 min read",
      views: 1834
    },
    {
      id: 7,
      title: "Long-Distance Touring: Preparing for Your Next Adventure",
      excerpt: "Planning a cross-country ride? Our comprehensive guide covers everything from gear selection to route planning for epic motorcycle adventures.",
      image: "https://images.unsplash.com/photo-1614228735037-c2a49b6f92b1?w=600&h=400&fit=crop",
      category: "tips",
      author: "Rudi Hartono",
      date: "July 8, 2024",
      readTime: "8 min read",
      views: 1298
    },
    {
      id: 8,
      title: "Anniversary Celebration: 4 Years of BOI Bekasi Brotherhood",
      excerpt: "Celebrating four amazing years of brotherhood, rides, and community service. Take a look back at our journey and achievements.",
      image: "https://images.unsplash.com/photo-1558618037-0062e50955a5?w=600&h=400&fit=crop",
      category: "recaps",
      author: "Ahmad Rizki",
      date: "July 5, 2024",
      readTime: "6 min read",
      views: 2245
    }
  ];

  const filteredArticles = selectedCategory === 'all' 
    ? articles 
    : articles.filter(article => article.category === selectedCategory);

  const getCategoryColor = (category: string) => {
    switch (category) {
      case 'tips': return 'bg-blue-500/20 text-blue-400';
      case 'recaps': return 'bg-green-500/20 text-green-400';
      case 'news': return 'bg-purple-500/20 text-purple-400';
      default: return 'bg-primary/20 text-primary';
    }
  };

  return (
    <section id="articles" className="py-20 bg-background">
      <div className="container mx-auto px-4">
        {/* Section Header */}
        <div className="text-center mb-16">
          <h2 className="section-title mb-6">ARTICLES & NEWS</h2>
          <p className="text-xl text-muted-foreground max-w-3xl mx-auto leading-relaxed">
            Stay informed with the latest motorcycle tips, event recaps, and industry news. 
            Written by our community for our community.
          </p>
        </div>

        {/* Category Filter */}
        <div className="flex flex-wrap justify-center gap-3 mb-12">
          {categories.map((category) => (
            <Button
              key={category.id}
              variant={selectedCategory === category.id ? "default" : "outline"}
              onClick={() => setSelectedCategory(category.id)}
              className={selectedCategory === category.id 
                ? "bg-primary text-primary-foreground" 
                : "border-border hover:border-primary/50"
              }
            >
              <Tag className="w-4 h-4 mr-2" />
              {category.label}
              <Badge variant="secondary" className="ml-2 text-xs">
                {category.count}
              </Badge>
            </Button>
          ))}
        </div>

        {/* Featured Article */}
        <Card className="biker-card mb-12 overflow-hidden">
          <div className="grid lg:grid-cols-2 gap-0">
            <div className="relative">
              <img
                src={articles[0].image}
                alt={articles[0].title}
                className="w-full h-full object-cover min-h-[300px]"
              />
              <div className="absolute inset-0 bg-black/30" />
              <Badge className={`absolute top-4 left-4 ${getCategoryColor(articles[0].category)}`}>
                {articles[0].category.charAt(0).toUpperCase() + articles[0].category.slice(1)}
              </Badge>
            </div>
            <CardContent className="p-8 flex flex-col justify-center">
              <Badge className="w-fit mb-4 bg-primary/20 text-primary">Featured Article</Badge>
              <h3 className="text-2xl font-bold text-foreground mb-4 leading-tight">
                {articles[0].title}
              </h3>
              <p className="text-muted-foreground mb-6 leading-relaxed">
                {articles[0].excerpt}
              </p>
              <div className="flex items-center gap-4 text-sm text-muted-foreground mb-6">
                <div className="flex items-center space-x-2">
                  <User className="w-4 h-4 text-primary" />
                  <span>{articles[0].author}</span>
                </div>
                <div className="flex items-center space-x-2">
                  <Calendar className="w-4 h-4 text-primary" />
                  <span>{articles[0].date}</span>
                </div>
                <div className="flex items-center space-x-2">
                  <Clock className="w-4 h-4 text-primary" />
                  <span>{articles[0].readTime}</span>
                </div>
              </div>
              <Button className="hero-button w-fit">
                Read Full Article
                <ArrowRight className="ml-2 w-4 h-4" />
              </Button>
            </CardContent>
          </div>
        </Card>

        {/* Articles Grid */}
        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          {filteredArticles.slice(1).map((article) => (
            <Card key={article.id} className="biker-card group hover:scale-105 transition-all duration-300 overflow-hidden">
              <div className="relative">
                <img
                  src={article.image}
                  alt={article.title}
                  className="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300"
                />
                <div className="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors duration-300" />
                <Badge className={`absolute top-4 left-4 ${getCategoryColor(article.category)}`}>
                  {article.category.charAt(0).toUpperCase() + article.category.slice(1)}
                </Badge>
              </div>
              
              <CardContent className="p-6">
                <h4 className="text-lg font-bold text-foreground mb-3 leading-tight group-hover:text-primary transition-colors">
                  {article.title}
                </h4>
                <p className="text-sm text-muted-foreground mb-4 leading-relaxed line-clamp-3">
                  {article.excerpt}
                </p>
                
                {/* Article Meta */}
                <div className="flex items-center justify-between text-xs text-muted-foreground mb-4">
                  <div className="flex items-center space-x-1">
                    <User className="w-3 h-3 text-primary" />
                    <span>{article.author}</span>
                  </div>
                  <div className="flex items-center space-x-1">
                    <Calendar className="w-3 h-3 text-primary" />
                    <span>{article.date}</span>
                  </div>
                </div>

                <div className="flex items-center justify-between">
                  <div className="flex items-center gap-4 text-xs text-muted-foreground">
                    <div className="flex items-center space-x-1">
                      <Clock className="w-3 h-3 text-primary" />
                      <span>{article.readTime}</span>
                    </div>
                    <div className="flex items-center space-x-1">
                      <Eye className="w-3 h-3 text-primary" />
                      <span>{article.views}</span>
                    </div>
                  </div>
                  <Button variant="ghost" size="sm" className="text-primary hover:text-primary-foreground hover:bg-primary">
                    Read More
                    <ArrowRight className="ml-1 w-3 h-3" />
                  </Button>
                </div>
              </CardContent>
            </Card>
          ))}
        </div>

        {/* Load More & Newsletter */}
        <div className="grid lg:grid-cols-2 gap-8 mt-16">
          <Card className="biker-card">
            <CardContent className="p-8 text-center">
              <h3 className="text-xl font-bold text-foreground mb-4">More Articles</h3>
              <p className="text-muted-foreground mb-6">
                Explore our complete archive of riding tips, event coverage, and motorcycle news.
              </p>
              <Button variant="outline" size="lg" className="border-primary/30 hover:bg-primary/10">
                View All Articles
              </Button>
            </CardContent>
          </Card>

          <Card className="biker-card">
            <CardContent className="p-8 text-center">
              <h3 className="text-xl font-bold text-foreground mb-4">Stay Updated</h3>
              <p className="text-muted-foreground mb-6">
                Subscribe to get the latest articles and event updates delivered to your inbox.
              </p>
              <Button size="lg" className="hero-button">
                Subscribe to Newsletter
              </Button>
            </CardContent>
          </Card>
        </div>
      </div>
    </section>
  );
};

export default ArticlesSection;