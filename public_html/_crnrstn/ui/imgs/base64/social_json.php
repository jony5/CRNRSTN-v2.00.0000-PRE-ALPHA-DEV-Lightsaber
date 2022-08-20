<?php
$tmp_str = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAABRCAYAAABxNOAUAAAErWlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjcyIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iODEiCiAgIGV4aWY6Q29sb3JTcGFjZT0iNjU1MzUiCiAgIHRpZmY6SW1hZ2VXaWR0aD0iNzIiCiAgIHRpZmY6SW1hZ2VMZW5ndGg9IjgxIgogICB0aWZmOlJlc29sdXRpb25Vbml0PSIyIgogICB0aWZmOlhSZXNvbHV0aW9uPSI5Ni8xIgogICB0aWZmOllSZXNvbHV0aW9uPSI5Ni8xIgogICBwaG90b3Nob3A6Q29sb3JNb2RlPSIzIgogICBwaG90b3Nob3A6SUNDUHJvZmlsZT0iRGlzcGxheSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDctMjhUMDE6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8uTJoLL79u3TeZKSktTVq1dDxkGlpaUBZb/44ougGCmSOMhUoI0bNwY4XbFihUpKStLn69atCwrnt2zZou1xcXGquLhY7d27V73//vtqwYIF2uZ0OlVHR0eAAGvWrAm439q1a1V1dbWqrKxURUVFAbaqqqqA+xoJ5PV6VUlJifUCdXR0qLlz54YcE2VnZ6tbt24Flenu7lZLly41HE8lJiaqurq6kPd75ZVXDMvGxcWpDz74QPX09EQskFJKtba2qoSEhAEJZDrdMWnSJD7//HN27dqFy+Xi4sWLzJ07l4yMDNLT04mLiwsqExsby44dO1i8eDHvvfceDQ0NuN1uAJ555hlmz57NqlWrSElJCXm/8vJycnJy2L17N6dOncLlcgGQlZXFE088wYsvvqjHdHff97XXXgPg8ccfD7InJiby8ccf69mHxx6LYLVrsGOxgeDxeFRbW5vq6uoaVHm32606OzstrlV4BtSCrCA6Ojqgpxso/WOkkcaecjXBFsgEWyATbIFM0B/p1tZWmpqa7mVdRg2tra06be/uMCEK39+W24SmziGEiML3p0x3T6rsADKBvwB/GumaDTN/wPf/C/0bCD236xuOfBPj33D9v7utQoi+neodUsrBTeiOUoQQfTNuXWbPZvdiJtgCmWALZIItkAm2QCYYTXf0dfvThBDzR6IyI0jwTF0YjATqW4543n+MRc6bZYgOZ4iNjb0F5ALjwuW5z/kXsNjj8RiuR/8fxEwsyYpdIqgAAAAASUVORK5CYII=';